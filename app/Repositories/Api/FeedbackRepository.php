<?php

namespace App\Repositories\Api;

use App\Models\Feedback;
use InfyOm\Generator\Common\BaseRepository;

class FeedbackRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'customer_id',
        'content',
        'img_path',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Feedback::class;
    }
}
