<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class IapIosCharging
 *
 * @package App\Models\Backend
 * @version July 2, 2017, 2:39 pm UTC
 * @property int $id
 * @property int $profile_id
 * @property int $amount Tiền vnd của goi
 * @property int $point Tiền icash của gói
 * @property string $product_id
 * @property string $apple_id
 * @property string $purchase_token
 * @property bool $charge_status Trạng thái: 0 thất bại, 1 thành công
 * @property string $response response từ server google
 * @property string|null $response_at
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\User $profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereAppleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereChargeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging wherePurchaseToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereResponseAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IapIosCharging whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class IapIosCharging extends Model
{

    public $table = 'e_iap_ios_charging';
    
    public $timestamps = false;



    public $fillable = [
        'profile_id',
        'amount',
        'point',
        'product_id',
        'apple_id',
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
        'amount' => 'integer',
        'point' => 'integer',
        'product_id' => 'string',
        'apple_id' => 'string',
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
    public function profile()
    {
        return $this->belongsTo(\App\User::class);
    }
}
