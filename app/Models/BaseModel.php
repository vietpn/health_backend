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
    public static function getImage($src, $width = 80, $height = 80)
    {
        if (empty($src)) {
            return "http://placehold.it/" . $width . "x" . $height;
        }
        return 'storage/' . $src;
    }

}