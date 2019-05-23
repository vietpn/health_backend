<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Config
 *
 * @package App\Models
 * @version June 26, 2017, 4:02 am UTC
 * @property int $id
 * @property string $key
 * @property string $value
 * @property string $describe
 * @property bool $status 1: Enable ; 0:Disable
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Config whereDescribe($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Config whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Config whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Config whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Config whereValue($value)
 * @mixin \Eloquent
 */
class Config extends Model
{

    public $table = 'e_config';
    
    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'status', 'id'
    ];

    public $fillable = [
        'key',
        'value',
        'describe',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'key' => 'string',
        'value' => 'string',
        'describe' => 'string',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
