<?php

namespace App\Repositories\Backend;

use App\Models\BussinesType;
use InfyOm\Generator\Common\BaseRepository;

class BussinesTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'status',
        'created_at',
        'created_id',
        'updated_at',
        'updated_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return BussinesType::class;
    }
}
