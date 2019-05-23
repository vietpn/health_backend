<?php

namespace App\Repositories\Api;

use App\Models\Pin;
use InfyOm\Generator\Common\BaseRepository;

class PinRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'avatar',
        'point',
        'status',
        'created_at',
        'created_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pin::class;
    }
}
