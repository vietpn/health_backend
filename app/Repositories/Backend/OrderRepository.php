<?php

namespace App\Repositories\Backend;

use App\Models\Order;
use InfyOm\Generator\Common\BaseRepository;

class OrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'profile_id',
        'total_price',
        'promo_code',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Order::class;
    }
}
