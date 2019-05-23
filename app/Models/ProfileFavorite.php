<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ProfileFavorite
 *
 * @package App\Models
 * @version July 5, 2017, 7:06 am UTC
 * @property int $id
 * @property int $profile_id
 * @property int $profile_id_favorite
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\User $eProfile
 * @property-read \App\User $eProfileFavorite
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileFavorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileFavorite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileFavorite whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileFavorite whereProfileIdFavorite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileFavorite whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProfileFavorite extends Model
{

    public $table = 'e_profile_favorite';
    
    public $timestamps = false;

    protected $hidden = [
        'created_at', 'updated_at', 'id', 'profile_id'
    ];

    public $fillable = [
        'profile_id',
        'profile_id_favorite',
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
        'profile_id_favorite' => 'integer'
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
    public function eProfile()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function eProfileFavorite()
    {
        return $this->belongsTo(\App\User::class);
    }
}
