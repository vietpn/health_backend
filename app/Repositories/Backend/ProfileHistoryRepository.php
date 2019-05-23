<?php

namespace App\Repositories\Backend;

use App\Models\ProfileHistory;
use InfyOm\Generator\Common\BaseRepository;

class ProfileHistoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'profile_id',
        'item_id',
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
        return ProfileHistory::class;
    }
    public function getHistoryByProfileId($id,$request){

    }
}
