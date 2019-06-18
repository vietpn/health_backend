<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Device
 * @package App\Models
 * @version June 18, 2019, 10:54 am +07
 */
class Device extends Model
{

    public $table = 'e_device';
    
    public $timestamps = false;



    public $fillable = [
        'profile_id',
        'device_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'profile_id' => 'integer',
        'device_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'device_token' => 'required',
    ];

    /**
     * @inheritdoc
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
        });

        self::updating(function ($model) {
            $model->updated_at = date('Y-m-d H:i:s');

        });
    }
}
