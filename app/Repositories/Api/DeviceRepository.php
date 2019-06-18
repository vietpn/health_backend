<?php

namespace App\Repositories\Api;

use App\Models\Device;
use InfyOm\Generator\Common\BaseRepository;

class DeviceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'profile_id',
        'device token',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Device::class;
    }
}
