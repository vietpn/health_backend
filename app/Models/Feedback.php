<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Feedback
 * @package App\Models
 * @version May 30, 2019, 8:47 am +07
 */
class Feedback extends Model
{

    public $table = 'e_feedback';

    public $timestamps = false;


    public $fillable = [
        'profile_id',
        'content',
        'img_path',
        'status',
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
        'content' => 'string',
        'img_path' => 'string',
        'status' => 'integer',
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
    public function getImgPathAttribute()
    {
        $arrImg = explode(',', $this->attributes['img_path']);
        if (!empty($arrImg)) {
            return $arrImg;
        } else {
            return $this->attributes['img_path'];
        }
    }

    /**
     * @inheritdoc
     */
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
