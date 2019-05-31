<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class OrderDetail
 * @package App\Models
 * @version May 30, 2019, 4:11 pm +07
 */
class OrderDetail extends Model
{

    public $table = 'e_order_detail';
    
    public $timestamps = false;



    public $fillable = [
        'order_id',
        'product_id',
        'product_name',
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
        'order_id' => 'integer',
        'product_id' => 'integer',
        'product_name' => 'string',
        'amount' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
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
