<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ProfileBlock
 *
 * @package App\Models
 * @version July 3, 2017, 8:54 am UTC
 * @property int $id
 * @property int $profile_id
 * @property int $profile_id_block
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\User $eProfile
 * @property-read \App\User $eProfileBlock
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBlock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBlock whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBlock whereProfileIdBlock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileBlock whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProfileBlock extends Model
{

    public $table = 'e_profile_block';
    
    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'id', 'profile_id'
    ];


    public $fillable = [
        'profile_id',
        'profile_id_block',
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
        'profile_id_block' => 'integer'
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
    public function eProfileBlock()
    {
        return $this->belongsTo(\App\User::class);
    }

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
