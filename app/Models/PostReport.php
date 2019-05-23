<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class PostReport
 * @package App\Models\V2
 * @version August 30, 2017, 9:40 am ICT
 */
class PostReport extends Model
{

    public $table = 'e_post_report';

    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'is_deleted'
    ];

    public $fillable = [
        'profile_id',
        'post_id',
        'is_deleted',
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
        'post_id' => 'integer',
        'is_deleted' => 'boolean'
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
    public function ePost()
    {
        return $this->belongsTo(\App\Models\Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function eProfile()
    {
        return $this->belongsTo(\App\User::class);
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
    }
}
