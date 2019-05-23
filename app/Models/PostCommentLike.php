<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class PostCommentLike
 *
 * @package App\Models\V2
 * @version July 11, 2017, 7:28 am UTC
 * @property int $id
 * @property int $profile_id Id của profile
 * @property int $post_comment_id Id của comment trong post
 * @property bool $is_deleted Trạng thái xóa: 0: chưa xóa; 1: đã xóa
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\PostComment $postComment
 * @property-read \App\User $profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCommentLike whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCommentLike whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCommentLike whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCommentLike wherePostCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCommentLike whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCommentLike whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostCommentLike extends Model
{

    public $table = 'e_post_comment_like';
    
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
        'post_comment_id',
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
        'post_comment_id' => 'integer',
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
    public function postComment()
    {
        return $this->belongsTo(\App\Models\PostComment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function profile()
    {
        return $this->belongsTo(\App\User::class);
    }
}
