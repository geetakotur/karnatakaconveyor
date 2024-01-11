<?php

namespace App\Models\Customer;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $guard = 'customer';

    public $table = "customer_user";   // Table Name

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name',
        'email',
        'mobile',
        'address',
        'city',
        'state',
        'registerd_on',

        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'id',
        // 'created_at',
        // 'updated_at',

        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'registerd_on' => 'date',
    ];

    public static function getModel()
    {
        $instance = new static;
        return $instance;
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

    public function scopeFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
