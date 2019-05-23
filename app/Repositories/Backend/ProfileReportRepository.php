<?php

namespace App\Repositories\Backend;

use App\Models\ProfileReport;
use InfyOm\Generator\Common\BaseRepository;

class ProfileReportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'profile_id',
        'profile_id_report',
        'status',
        'des',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProfileReport::class;
    }
}
