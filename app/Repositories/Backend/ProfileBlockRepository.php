<?php

namespace App\Repositories\Backend;

use App\Models\ProfileBlock;
use InfyOm\Generator\Common\BaseRepository;

class ProfileBlockRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'profile_id',
        'profile_id_block',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProfileBlock::class;
    }
}
