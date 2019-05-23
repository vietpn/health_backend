<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class IapAndroid
 *
 * @package App\Models
 * @version June 28, 2017, 4:03 am UTC
 * @property int $id
 * @property string $product_id
 * @property string $avatar
 * @property string $display_name
 * @property string $package
 * @property string $description
 * @property float $price Giá tiền tính theo usd
 * @property int $point
 * @property bool $status 1: Enable ; 0:Disable
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $created_id
 * @property int $updated_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid wherePackage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroid whereUpdatedId($value)
 * @mixin \Eloquent
 */
class IapAndroid extends Model
{

    public $table = 'e_iap_android';
    
    public $timestamps = false;



    public $fillable = [
        'product_id',
        'avatar',
        'display_name',
        'package',
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
        'product_id' => 'string',
        'avatar' => 'string',
        'display_name' => 'string',
        'package' => 'string',
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

    public function getAvatarAttribute()
    {
        //Custom when call API
        if (strpos(\Route::getCurrentRoute()->getActionName(), 'Http\\Controllers\\API') !== false) {
            return $this->attributes['avatar'] = env('APP_STORAGE_URL', '') . $this->attributes['avatar'];
        }
        return $this->attributes['avatar'];
    }

    protected $hidden = ['created_id', 'updated_at', 'updated_id'];

}
