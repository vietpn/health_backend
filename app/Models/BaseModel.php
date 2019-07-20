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

    const STATUS_FEEDBACK_NEW = 0;
    const STATUS_FEEDBACK_READED = 1;

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
            switch ($status) {
                case self::STATUS_WAIT:
                    return '<span class="label label-warning">' . $arr[$status] . '</span>';
                    break;
                case self::STATUS_CONFIRM:
                    return '<span class="label label-primary">' . $arr[$status] . '</span>';
                    break;
                case self::STATUS_DELETE:
                    return '<span class="label label-danger">' . $arr[$status] . '</span>';
                    break;
                case self::STATUS_DONE:
                    return '<span class="label label-success">' . $arr[$status] . '</span>';
                    break;
                default:
                    return '<span class="label label-default">' . $arr[$status] . '</span>';
                    break;
            }
        } else {
            return "N/A";
        }
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_WAIT => 'Chờ Xác Nhận',
            self::STATUS_CONFIRM => 'Xác Nhận',
            self::STATUS_DELETE => 'Huỷ',
            self::STATUS_DONE => 'Đã Giao Hàng'
        ];
    }


    public static function getStatusFeedback($status)
    {
        $arr = BaseModel::getStatusFeedBackList();
        if (isset($arr[$status])) {
            switch ($status) {
                case self::STATUS_FEEDBACK_NEW:
                    return '<span class="label label-danger">' . $arr[$status] . '</span>';
                    break;
                case self::STATUS_FEEDBACK_READED:
                    return '<span class="label label-success">' . $arr[$status] . '</span>';
                    break;
            }
        } else {
            return "N/A";
        }
    }

    public static function getStatusFeedBackList()
    {
        return [
            self::STATUS_FEEDBACK_NEW => 'New',
            self::STATUS_FEEDBACK_READED => 'Đã Đọc',
        ];
    }

}