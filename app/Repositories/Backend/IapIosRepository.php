<?php

namespace App\Repositories\Backend;

use App\Models\IapIos;
use InfyOm\Generator\Common\BaseRepository;

class IapIosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'apple_id',
        'product_id',
        'avatar',
        'display_name',
        'description',
        'price',
        'point',
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
        return IapIos::class;
    }
}
