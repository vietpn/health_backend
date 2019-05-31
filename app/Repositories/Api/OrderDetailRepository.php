<?php

namespace App\Repositories\Api;

use App\Models\OrderDetail;
use InfyOm\Generator\Common\BaseRepository;

class OrderDetailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'product_id',
        'product_name',
        'amount',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderDetail::class;
    }
}
