<?php

namespace App\Repositories\Backend;

use App\Models\IapIosCharging;
use InfyOm\Generator\Common\BaseRepository;

class IapIosChargingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'profile_id',
        'amount',
        'point',
        'product_id',
        'apple_id',
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
        return IapIosCharging::class;
    }
}
