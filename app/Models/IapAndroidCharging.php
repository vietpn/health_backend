<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class IapAndroidCharging
 *
 * @package App\Models\Backend
 * @version June 30, 2017, 7:43 am UTC
 * @property int $id
 * @property int $profile_id
 * @property bool $type 1: kiểu managed product, 2: kiểu subscription
 * @property int $amount Tiền vnd của goi
 * @property int $point Tiền icash của gói
 * @property string $product_id
 * @property string $package
 * @property string $purchase_token
 * @property bool $charge_status Trạng thái: 0 thất bại, 1 thành công
 * @property string $response response từ server google
 * @property string|null $response_at
 * @property string $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\CmsUser $Profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereChargeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging wherePackage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging wherePurchaseToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereResponseAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapAndroidCharging whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class IapAndroidCharging extends Model
{

    public $table = 'e_iap_android_charging';
    
    public $timestamps = false;



    public $fillable = [
        'profile_id',
        'type',
        'amount',
        'point',
        'product_id',
        'package',
        'purchase_token',
        'charge_status',
        'response',
        'response_at',
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
        'type' => 'boolean',
        'amount' => 'integer',
        'point' => 'integer',
        'product_id' => 'string',
        'package' => 'string',
        'purchase_token' => 'string',
        'charge_status' => 'boolean',
        'response' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function Profile()
    {
        return $this->belongsTo(\App\Models\CmsUser::class);
    }
}
