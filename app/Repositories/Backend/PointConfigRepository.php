<?php

namespace App\Repositories\Backend;

use App\Models\PointConfig;
use InfyOm\Generator\Common\BaseRepository;

class PointConfigRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'key',
        'point',
        'describe',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PointConfig::class;
    }
}
