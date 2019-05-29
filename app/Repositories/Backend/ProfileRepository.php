<?php

namespace App\Repositories\Backend;

use App\Models\Profile;
use InfyOm\Generator\Common\BaseRepository;

class ProfileRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'username',
        'name',
        'email',
        'phone_number',
        'birthday',
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Profile::class;
    }
}
