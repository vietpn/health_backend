<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Order
 * @package App\Models\Api
 * @version May 30, 2019, 3:47 pm +07
 */
class Order extends Model
{

    public $table = 'e_order';
    
    public $timestamps = false;



    public $fillable = [
        'profile_id',
        'total_price',
        'promo_code',
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
        'profile_id' => 'integer',
        'total_price' => 'float',
        'promo_code' => 'string',
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
