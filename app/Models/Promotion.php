<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Promotion
 * @package App\Models
 * @version June 8, 2019, 11:06 pm +07
 */
class Promotion extends Model
{

    public $table = 'e_promotion';
    
    public $timestamps = false;



    public $fillable = [
        'title',
        'content',
        'img_path',
        'code',
        'value',
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
        'title' => 'string',
        'content' => 'string',
        'img_path' => 'string',
        'code' => 'string',
        'value' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'max:100',
    ];

    /**
     * @inheritdoc
     */
    public function getImgPathAttribute()
    {
        if (strpos(\Route::getCurrentRoute()->getActionName(), 'Http\\Controllers\\API') !== false) {
            $this->attributes['img_path'] = env('APP_STORAGE_URL', '') . $this->attributes['img_path'];
        }
        return $this->attributes['img_path'];
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
