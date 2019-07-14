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

    protected $appends = ['order_id'];


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
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function orderDetail()
    {
        return $this->hasMany(\App\Models\OrderDetail::class);
    }

    /**
     * @inheritdoc
     */
    public function getOrderIdAttribute()
    {
        $orderId = '';
        if (strpos(\Route::getCurrentRoute()->getActionName(), 'Http\\Controllers\\API') !== false) {
            $createdAt = new \DateTime($this->attributes['created_at']);
            if ($createdAt) {
                $orderId = $createdAt->format("ymdHis");
            }
        }
        return $orderId;
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
