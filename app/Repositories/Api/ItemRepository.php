<?php

namespace App\Repositories\Api;

use App\Models\Item;
use InfyOm\Generator\Common\BaseRepository;

class ItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'avatar',
        'point',
        'description',
        'status',
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
        return Item::class;
    }
}
