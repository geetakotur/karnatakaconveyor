<?php

namespace App\Models\Mgmt;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employee extends Model{
    use HasFactory;

    public $table = "employees";   // Table Name

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'eid',

        'name',
        'email',
        'address',

        'salary',

        'joining_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
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
            $model->eid = Str::uuid();
        });
    }

}
