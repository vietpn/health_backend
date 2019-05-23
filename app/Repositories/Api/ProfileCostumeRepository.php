<?php

namespace App\Repositories\Api;

use App\Models\ProfileCostume;
use InfyOm\Generator\Common\BaseRepository;

class ProfileCostumeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'profile_id',
        'item_ids',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProfileCostume::class;
    }
}
