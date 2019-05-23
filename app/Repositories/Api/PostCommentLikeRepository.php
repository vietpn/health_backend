<?php

namespace App\Repositories\Api;

use App\Models\PostCommentLike;
use InfyOm\Generator\Common\BaseRepository;

class PostCommentLikeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'profile_id',
        'post_comment_id',
        'is_deleted',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PostCommentLike::class;
    }
}
