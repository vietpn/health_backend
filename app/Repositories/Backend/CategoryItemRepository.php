<?php

namespace App\Repositories\Backend;

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
        'created_at',
        'updated_at',
        'created_id',
        'updated_id',
        'type',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CategoryItem::class;
    }
}
