<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ProfileItemHistory
 *
 * @package App\Models\Backend
 * @version August 4, 2017, 10:53 am ICT
 * @property int $id
 * @property int $profile_id
 * @property int $item_id
 * @property float $point
 * @property string|null $created_at
 * @property-read \App\Models\Item $eItem
 * @property-read \App\User $eProfile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileItemHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileItemHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileItemHistory whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileItemHistory wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProfileItemHistory whereProfileId($value)
 * @mixin \Eloquent
 */
class ProfileItemHistory extends Model
{

    public $table = 'e_profile_item_history';
    
    public $timestamps = false;

    public $fillable = [
        'profile_id',
        'item_id',
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
        'item_id' => 'integer',
        'point' => 'float'
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
    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function profile()
    {
        return $this->belongsTo(\App\User::class, 'profile_id');
    }
}
