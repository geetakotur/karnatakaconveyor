<?php

namespace App\Models\Customer;

use App\Models\Customer\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

use App\Models\Customer\User as CustomerUser;

class OrderDetail extends Model
{
    use HasFactory;     // Database Factory

    public $table = "customer_order_details";   // Table Name

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_date',
        'payment',
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
        'order_date' => 'date',
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

            $invoiceId = $invoiceId[0] . $invoiceId[1];
            $model->invoiceId = 'INVOICE-' . $invoiceId;

            $model->order_date = Carbon::now();
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


    public function order()
    {
        return $this->belongsTo(Order::class, 'id', 'order_id');
    }
}
