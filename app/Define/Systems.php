<?php

namespace App\Define;

/**
 * Created by PhpStorm.
 * User: tienmx
 * Date: 5/8/2017
 * Time: 8:49 AM
 */
use App\Models\Backend\RankConfig;
use SEOMeta, OpenGraph, Twitter, SEO, Route, URL;
use Log;
use Intervention\Image\ImageManagerStatic as Image;
use Cache;

class Systems
{
    public static function formatPrice($price, $decimal = 2)
    {

        if ($price == '' || $price == 0)
            return '0';
        return number_format($price, $decimal, '.', ',') . '';
    }

}