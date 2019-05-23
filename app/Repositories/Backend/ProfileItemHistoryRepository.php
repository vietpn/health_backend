<?php

namespace App\Repositories\Backend;

use App\Models\ProfileItemHistory;
use InfyOm\Generator\Common\BaseRepository;

class ProfileItemHistoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'profile_id',
        'item_id',
        'point',
        'created_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProfileItemHistory::class;
    }
}
