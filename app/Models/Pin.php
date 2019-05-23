<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Pin
 *
 * @package App\Models
 * @version July 19, 2017, 10:07 am ICT
 * @property int $id
 * @property string $name
 * @property string $avatar
 * @property int $point
 * @property bool $status
 * @property string|null $created_at
 * @property int $created_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pin whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pin whereCreatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pin wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pin whereStatus($value)
 * @mixin \Eloquent
 */
class Pin extends Model
{

    public $table = 'e_pin';
    
    public $timestamps = false;

    protected $hidden = [
        'created_id','created_at','status',
    ];

    public $fillable = [
        'name',
        'avatar',
        'point',
        'status',
        'created_at',
        'created_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'avatar' => 'string',
        'point' => 'integer',
        'status' => 'boolean',
        'created_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'avatar' => 'required|image|mimes:png',
        'point' => 'required',
    ];

    /**
     * @inheritdoc
     */
    public function getAvatarAttribute()
    {

//        if (strpos(\Route::getCurrentRoute()->getActionName(), 'Http\\Controllers\\API') !== false) {
//            return $this->attributes['avatar'] = env('APP_STORAGE_URL', '') . $this->attributes['avatar'];
//        }
        return env('APP_STORAGE_URL', '') . $this->attributes['avatar'];
//        return 'storage/'.$this->attributes['avatar'];
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $user = \Sentinel::check();
            if (isset($user)){
                $model->created_id = $user->getUserId();
            }
        });
    }
}
