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
    // Status
    const STATUS_WAIT = 0;
    const STATUS_CONFIRM = 1;
    const STATUS_DELETE = 2;
    const STATUS_DONE = 3;

    public static function getImage($src, $width = 80, $height = 80)
    {
        if (empty($src)) {
            return "http://placehold.it/" . $width . "x" . $height;
        }
        return 'storage/' . $src;
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

    public static function getStatusList()
    {
        return [
            self::STATUS_WAIT => 'Chờ xác nhận',
            self::STATUS_CONFIRM => 'Xác nhận',
            self::STATUS_DELETE => 'Huỷ',
            self::STATUS_DONE => 'Đã giao hàng'
        ];
    }

}