<?php

namespace App\Repositories\Api;

use App\Models\PostView;
use InfyOm\Generator\Common\BaseRepository;

class PostViewRepository extends BaseRepository
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
        return PostView::class;
    }
}
