<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class IapIos
 *
 * @package App\Models
 * @version June 28, 2017, 4:13 am UTC
 * @property int $id
 * @property string $apple_id
 * @property string $product_id
 * @property string $avatar
 * @property string $display_name
 * @property string $description
 * @property float $price Giá tiền tính theo usd
 * @property int $point
 * @property bool $status 1: Enable ; 0:Disable
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $created_id
 * @property int $updated_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereAppleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIos whereUpdatedId($value)
 * @mixin \Eloquent
 */
class IapIos extends Model
{

    public $table = 'e_iap_ios';
    
    public $timestamps = false;



    public $fillable = [
        'apple_id',
        'product_id',
        'avatar',
        'display_name',
        'description',
        'price',
        'point',
        'status',
        'created_at',
        'updated_at',
        'created_id',
        'updated_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'apple_id' => 'string',
        'product_id' => 'string',
        'avatar' => 'string',
        'display_name' => 'string',
        'description' => 'string',
        'price' => 'float',
        'point' => 'integer',
        'status' => 'boolean',
        'created_id' => 'integer',
        'updated_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
