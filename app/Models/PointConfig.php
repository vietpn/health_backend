<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class PointConfig
 *
 * @package App\Models\Backend
 * @version August 23, 2017, 10:16 am ICT
 * @property int $id
 * @property string $key
 * @property int $point
 * @property string $describe
 * @property bool $status 1: Enable ; 0:Disable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointConfig whereDescribe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointConfig whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointConfig wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PointConfig whereStatus($value)
 * @mixin \Eloquent
 */
class PointConfig extends Model
{

    public $table = 'e_point_config';

    public $timestamps = false;


    public $fillable = [
        'key',
        'point',
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
        'point' => 'integer',
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

    /**
     * @inheritdoc
     */
    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            if ((int)$model->status === BaseModel::STATUS_ENABLE) {

                \Redis::set($model->key, (int)$model->point);
            }else{
                \Redis::del($model->key);
            }
        });

        self::updated(function ($model) {
            if ((int)$model->status === BaseModel::STATUS_ENABLE) {
                \Redis::set($model->key, (int)$model->point);
            }else{
                \Redis::del($model->key);
            }
        });

        self::deleted(function ($model) {
            \Redis::del($model->key);
        });
    }

}
