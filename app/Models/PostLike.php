<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class PostLike
 *
 * @package App\Models
 * @version July 7, 2017, 9:39 am UTC
 * @property int $id
 * @property int $profile_id Id của profile
 * @property int $post_id Id của post
 * @property bool $is_deleted Trạng thái xóa: 0: chưa xóa; 1: đã xóa
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\Post $ePost
 * @property-read \App\User $eProfile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLike whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLike whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLike whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLike wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLike whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostLike whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostLike extends Model
{

    public $table = 'e_post_like';
    
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

        self::created(function ($model) {
            BaseModel::updateElastichsearchPost($model->post_id);
        });

        self::updating(function ($model) {
            $model->updated_at = date('Y-m-d H:i:s');
        });

        self::updated(function ($model) {
            BaseModel::updateElastichsearchPost($model->post_id);
        });

        self::deleted(function ($model) {
            BaseModel::updateElastichsearchPost($model->post_id);
        });
    }
}
