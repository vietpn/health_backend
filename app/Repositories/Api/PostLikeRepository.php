<?php

namespace App\Repositories\Api;

use App\Models\PostLike;
use InfyOm\Generator\Common\BaseRepository;

class PostLikeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'profile_id',
        'post_id',
        'is_deleted',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PostLike::class;
    }
}
