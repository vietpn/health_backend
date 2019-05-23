<?php

namespace App\Repositories\Backend;

use App\Models\ProfileFavorite;
use InfyOm\Generator\Common\BaseRepository;

class ProfileFavoriteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'profile_id',
        'profile_id_favorite',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProfileFavorite::class;
    }
}
