<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class PostView
 *
 * @package App\Models\V2
 * @version July 11, 2017, 3:58 am UTC
 * @property int $id
 * @property int $profile_id Id của profile
 * @property int $post_id Id của bài post
 * @property bool $is_deleted Trạng thái xóa: 0: chưa xóa; 1: đã xóa
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\Post $ePost
 * @property-read \App\User $eProfile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostView whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostView whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostView whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostView wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostView whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostView whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostView extends Model
{

    public $table = 'e_post_view';
    
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
    public function eProfile()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function ePost()
    {
        return $this->belongsTo(\App\Models\Post::class);
    }
}
