<?php

namespace App\Models;

use Elasticsearch;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BaseModel
 *
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    public static function getStatusList()
    {
        return [
            self::STATUS_ENABLE => trans("app.enable"),
            self::STATUS_DISABLE => trans("app.disable")
        ];
    }

    public static function getStatusName($status)
    {
        $arr = BaseModel::getStatusList();
        if (isset($arr[$status])) {
            return $arr[$status];
        } else {
            return "N/A";
        }
    }

}