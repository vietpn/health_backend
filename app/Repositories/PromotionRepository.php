<?php

namespace App\Repositories;

use App\Models\Promotion;
use InfyOm\Generator\Common\BaseRepository;

class PromotionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'content',
        'img_path',
        'code',
        'value',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Promotion::class;
    }
}
