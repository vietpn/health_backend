<?php

namespace App\Models\Backend;

use Eloquent as Model;

/**
 * Class RankConfig
 *
 * @package App\Models\Backend
 * @version October 4, 2017, 10:19 am ICT
 * @property int $id
 * @property string $name Name rank
 * @property int $begin Point set default
 * @property int $end Rank end
 * @property bool $time set time rank 3 month,6 month,1 year
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\RankConfig whereBegin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\RankConfig whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\RankConfig whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\RankConfig whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\RankConfig whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\RankConfig whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Backend\RankConfig whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RankConfig extends Model
{

    public $table = 'e_rank_config';
    
    public $timestamps = false;



    public $fillable = [
        'name',
        'begin',
        'end',
        'time',
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
        'name' => 'string',
        'begin' => 'integer',
        'end' => 'integer',
        'time' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
