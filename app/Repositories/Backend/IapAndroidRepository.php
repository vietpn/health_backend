<?php

namespace App\Repositories\Backend;

use App\Models\IapAndroid;
use InfyOm\Generator\Common\BaseRepository;

class IapAndroidRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'avatar',
        'display_name',
        'package',
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
        return IapAndroid::class;
    }
}
