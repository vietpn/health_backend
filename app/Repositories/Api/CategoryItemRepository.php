<?php

namespace App\Repositories\Api;

use App\Models\CategoryItem;
use InfyOm\Generator\Common\BaseRepository;

class CategoryItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'avatar',
        'status',
        'sort_order',
        'created_at',
        'updated_at',
        'created_id',
        'updated_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CategoryItem::class;
    }
}
