<?php

namespace App\Repositories\Backend;

use App\Models\Product;
use InfyOm\Generator\Common\BaseRepository;

class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'img_path',
        'price',
        'new_price',
        'packaging',
        'manufacturer',
        'content',
        'chemicals',
        'amount',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product::class;
    }
}
