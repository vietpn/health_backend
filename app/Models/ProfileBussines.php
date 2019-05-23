<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Shop
 *
 * @package App\Models\Backend
 * @version July 11, 2017, 3:01 am UTC
 * @property int $id
 * @property int $profile_id
 * @property string $name
 * @property string $avatar
 * @property string $hyperlink Link url of shop
 * @property string $rel_hyperlink
 * @property int $bussines_type_id Bussines type
 * @property string $mobile
 * @property string|null $created_at
 * @property int $updated_id
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereBussinesTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereHyperlink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBussines whereUpdatedId($value)
 * @mixin \Eloquent
 * @property-read \App\User $eProfile
 */
class ProfileBussines extends Model
{

    public $table = 'e_profile_bussines';

    public $timestamps = false;


    public $fillable = [
        'profile_id',
        'name',
        'avatar',
        'hyperlink',
        'rel_hyperlink',
        'bussines_type_id',
        'mobile',
        'created_at',
        'updated_id',
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
        'name' => 'string',
        'avatar' => 'string',
        'hyperlink' => 'string',
        'rel_hyperlink' => 'string',
        'bussines_type_id' => 'integer',
        'mobile' => 'string',
        'updated_id' => 'integer'
    ];
    /**
     * @var array
     */
    protected $hidden = [
        'id', 'updated_id', 'updated_at', 'profile_id', 'created_at',
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
    public function getAvatarAttribute()
    {
        //Custom when call API
        if (!empty($this->attributes['avatar'])) {
            $this->attributes['avatar'] = env('APP_STORAGE_URL', '') . $this->attributes['avatar'];
        }
        return $this->attributes['avatar'];
    }

    public static function boot()
    {
        parent::boot();

//        self::creating(function ($model) {
////            $user = \Sentinel::check();
//            if (isset($user)){
//                $model->profile_id = $user->getUserId();
//            }
//            $model->updated_at = date('Y-m-d H:i:s');
//        });
//
//        self::updating(function ($model) {
//            $user = \Sentinel::check();
//            if (isset($user)){
//                $model->updated_id = $user->getUserId();
//            }
//            $model->updated_at = date('Y-m-d H:i:s');
//        });
    }

    public function eProfile()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function getBussinessType()
    {
        return $this->hasOne(BussinesType::class, 'id', 'bussines_type_id');
    }

    /**
     * @var array
     */
    public static $mapAttribute = [
        'profile_id',
        'name',
        'avatar',
        'hyperlink',
        'bussines_type_id',
        'mobile',
        'created_at',
        'updated_id',
        'updated_at'
    ];
}
