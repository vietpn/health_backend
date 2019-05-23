<?php

namespace App\Repositories\Api;

use App\Models\ProfilePinHistory;
use InfyOm\Generator\Common\BaseRepository;

class ProfilePinHistoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'profile_id',
        'pin_id',
        'post_id',
        'point',
        'created_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProfilePinHistory::class;
    }
}
