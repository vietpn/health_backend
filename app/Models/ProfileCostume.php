<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ProfileCostume
 * @package App\Models
 * @version September 27, 2017, 11:20 am ICT
 */
class ProfileCostume extends Model
{

    public $table = 'e_profile_costume';
    
    public $timestamps = false;



    public $fillable = [
        'profile_id',
        'item_ids',
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
        'item_ids' => 'string'
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
}
