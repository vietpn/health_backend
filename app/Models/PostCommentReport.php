<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class PostCommentReport
 * @package App\Models
 * @version September 20, 2017, 10:42 am ICT
 */
class PostCommentReport extends Model
{

    public $table = 'e_post_comment_report';

    public $timestamps = false;


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
