<?php

namespace App\Repositories\Backend;

use App\Models\Backend\ProfilePlusHistory;
use InfyOm\Generator\Common\BaseRepository;

class ProfilePlusHistoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'profile_id',
        'point',
        'type',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProfilePlusHistory::class;
    }
}
