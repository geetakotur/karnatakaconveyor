<?php

namespace App\Models\Mgmt;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conveyor extends Model
{
    use HasFactory;     // Database Factory

    public $table = "conveyor_model";   // Table Name

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'modelno', 'image', 'desc',

        'application',
        'width',
        'weight',
        'load',
        'speed',
        'movement',
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
        // 'item' => 'type',
    ];


    /**
     *  Model boot function
     *
     *  @return void
     */
    public static function boot()
    {
        parent::boot();

    //     self::creating(function($model){
    //     });

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
}
