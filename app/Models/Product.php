<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Product
 * @package App\Models
 * @version May 30, 2019, 9:37 am +07
 */
class Product extends Model
{

    public $table = 'e_product';
    
    public $timestamps = false;



    public $fillable = [
        'name',
        'img_path',
        'price',
        'new_price',
        'packaging',
        'manufacturer',
        'content',
        'chemicals',
        'amount',
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
        'name' => 'string',
        'img_path' => 'string',
        'price' => 'float',
        'new_price' => 'float',
        'packaging' => 'string',
        'manufacturer' => 'string',
        'content' => 'string',
        'chemicals' => 'string',
        'amount' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
