<?php

namespace App\Repositories\Backend;

use App\Models\ProfileBussines;
use InfyOm\Generator\Common\BaseRepository;

class ProfileBusinessRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'profile_id',
        'name',
        'avatar',
        'hyperlink',
        'rel_hyperlink',
        'bussines_type_id',
        'mobile',
        'created_at',
        'updated_id',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProfileBussines::class;
    }
}
