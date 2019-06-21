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
        'name' => 'max:200',
    ];

    /**
     * @inheritdoc
     */
    public function getImgPathAttribute()
    {
        return env('APP_STORAGE_URL', '') . $this->attributes['img_path'];
    }

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
