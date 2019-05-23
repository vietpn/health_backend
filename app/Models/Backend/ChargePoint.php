<?php

namespace App\Models\Backend;

use Eloquent as Model;

/**
 * Class ChargePoint
 * @package App\Models\Backend
 * @version October 25, 2017, 1:57 pm ICT
 */
class ChargePoint extends Model
{

    public $table = 'e_charge_point';
    
    public $timestamps = false;



    public $fillable = [
        'price',
        'point',
        'status',
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
        'price' => 'integer',
        'point' => 'integer',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
