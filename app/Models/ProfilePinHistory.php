<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ProfilePinHistory
 *
 * @package App\Models
 * @version October 12, 2017, 9:24 am ICT
 * @property int $id
 * @property int $profile_id
 * @property int $pin_id
 * @property int $post_id
 * @property int $point
 * @property string|null $created_at
 * @property-read \App\Models\Pin $pin
 * @property-read \App\User $profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfilePinHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfilePinHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfilePinHistory wherePinId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfilePinHistory wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfilePinHistory wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfilePinHistory whereProfileId($value)
 * @mixin \Eloquent
 */
class ProfilePinHistory extends Model
{

    public $table = 'e_profile_pin_history';
    
    public $timestamps = false;



    public $fillable = [
        'profile_id',
        'pin_id',
        'post_id',
        'point',
        'created_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'profile_id' => 'integer',
        'pin_id' => 'integer',
        'post_id' => 'integer',
        'point' => 'integer'
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
    public function pin()
    {
        return $this->belongsTo(\App\Models\Pin::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function profile()
    {
        return $this->belongsTo(\App\User::class, 'profile_id');
    }
}
