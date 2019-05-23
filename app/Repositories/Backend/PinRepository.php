<?php

namespace App\Repositories\Backend;

use App\Models\Pin;
use InfyOm\Generator\Common\BaseRepository;

class PinRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'image',
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
