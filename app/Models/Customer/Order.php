<?php

namespace App\Models\Customer;

use App\Models\Mgmt\Conveyor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

use App\Models\Customer\User as CustomerUser;

class Order extends Model
{
    use HasFactory;     // Database Factory

    public $table = "customer_order";   // Table Name

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_date',
        'invoiceId',
        'payment',
        
        'customer_id',
        'model_id',

        'isQuote',
        'approved',
        'status',
        'total',
        'message',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'order_date' => 'datetime',
    ];


    /**
     *  Model boot function
     *
     *  @return void
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $invoiceId = explode('-', Str::uuid()->toString());
            // print_r($invoiceId);

            $invoiceId = $invoiceId[0] . $invoiceId[1] . '-' . $invoiceId[2];
            $model->invoiceId = $invoiceId;

            $model->order_date = Carbon::now()->toDateTimeString();
        });

    //     self::created(function($model){
    //     });

    //     self::updating(function($model){
    //     });

    //     self::updated(function($model){
    //     });

    //     self::deleting(function($model){
    //     });

    //     self::deleted(function($model){
    //     });
    }


    /**
     *  Custom function
     *
     *  @param array
     *  @return string|null
     */
    // public function functionName()
    // {
    //     return 'value';
    // }


    public function customer()
    {
        return $this->hasOne(CustomerUser::class, 'id', 'customer_id');
    }

    public function model()
    {
        return $this->hasOne(Conveyor::class, 'id', 'model_id');
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'id', 'order_id');
    }


    public const STATUS_DEFAULT = "0";
    public const STATUS_PENDING = "1";
    public const STATUS_DUE = "2";
    public const STATUS_CLOSED = "3";
    public const STATUS_CANCELLED = "4";

    public function scopeGetStatus()
    {
        $msg = '';
        switch ($this->status) {
            case Order::STATUS_PENDING:
                $msg = 'Pending for approval';
            break;

            case Order::STATUS_DUE:
                $msg = 'due for payment';
            break;

            case Order::STATUS_CLOSED:
                $msg = 'closed';
            break;

            case Order::STATUS_CANCELLED:
                $msg = 'Cancelled';
            break;
            
            case Order::STATUS_DEFAULT:
            default:
                $msg = 'Undefined';
            break;
        }
        
        return $msg;
    }


    public function scopeGetPrice()
    {
        // dd($this->total);
        return $this->convertToINR($this->total);
    }

    public function scopeGetPriceWords()
    {
        // dd($this->total);
        return $this->convertToINRWords($this->total);
    }

    public function convertToINR($number)
    {
        $decimal = (string)($number - floor($number));
        $money = floor($number);
        $length = strlen($money);
        $delimiter = '';
        $money = strrev($money);

        for($i=0;$i<$length;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
                $delimiter .=',';
            }
            $delimiter .=$money[$i];
        }

        $result = strrev($delimiter);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);

        if( $decimal != '0'){
            $result = $result.$decimal;
        }

        return $result;
    }

    function convertToINRWords(float $number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred','thousand','lakh', 'crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise . ' only.';
    }

    // Calcs 2 remove GST from base amount,
    //  GST Amount  = Original Cost – (Original Cost * (100 / (100 + GST% ) ) )
    //  Net Price   = Original Cost – GST Amount

    public function scopeGetNetFromTotal($_, $per = 18)
    {
        $total = $this->total;
        $net = $total - $this->getGSTFromTotal($percent=$per);
        return number_format((float) $net, 2, '.', '');
    }

    public function scopeGetGSTFromTotal($_, $percent = 9)
    {
        $total = $this->total;
        $gst = $total - ( $total * ( 100 / (100 + $percent)));
        return number_format((float) $gst, 2, '.', '');
    }
}
