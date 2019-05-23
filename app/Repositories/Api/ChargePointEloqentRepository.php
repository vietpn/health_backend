<?php
/**
 * Created by PhpStorm.
 * User: tienmx
 * Date: 10/25/2017
 * Time: 2:01 PM
 */

namespace App\Repositories\Api;


use App\Models\Backend\ChargePoint;
use App\Models\BaseModel;
use App\Repositories\EloquentRepository;

class ChargePointEloqentRepository extends EloquentRepository
{

    public function getModel()
    {
        return ChargePoint::class;
    }
    public function getAll()
    {
        return $this->_model->where('status',BaseModel::STATUS_ENABLE)
            ->orderBy('id',SORT_DESC)->get();
    }
}