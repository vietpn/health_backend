<?php

namespace App\Repositories\Backend;

use App\Models\Config;
use InfyOm\Generator\Common\BaseRepository;

class ConfigRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'key',
        'value',
        'describe',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Config::class;
    }
}
