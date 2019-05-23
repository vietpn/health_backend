<?php

namespace App\Repositories\Backend;

use App\Models\Backend\ChargePoint;
use InfyOm\Generator\Common\BaseRepository;

class ChargePointRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'point',
        'price',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ChargePoint::class;
    }
}
