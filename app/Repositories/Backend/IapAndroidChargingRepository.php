<?php

namespace App\Repositories\Backend;

use App\Models\IapAndroidCharging;
use InfyOm\Generator\Common\BaseRepository;

class IapAndroidChargingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'profile_id',
        'type',
        'amount',
        'point',
        'product_id',
        'package',
        'purchase_token',
        'charge_status',
        'response',
        'response_at',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return IapAndroidCharging::class;
    }
}
