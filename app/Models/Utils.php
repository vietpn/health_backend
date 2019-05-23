<?php
/**
 * Created by JetBrains PhpStorm.
 * To change this template use File | Settings | File Templates.
 */
namespace App\Models;

class Utils
{
    /**
     * Remove non-numeric, non-alphabet character.
     * @param $string
     * @param string $replace
     * @return mixed
     */
    public static function removeNonAlphaNumberic($string, $replace = "")
    {
        return preg_replace("/[^a-zA-Z0-9]/", $replace, $string);
    }

    /**
     * Remove accents character
     * @param $str
     * @return mixed
     */
    public static function stripAccents($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace('/[^\w\d_ -]/si', '', $str);
        return $str;
    }

    public static function getAlias($str)
    {
        $str = self::stripAccents($str);
        $str = self::removeNonAlphaNumberic($str, " ");
        $str = preg_replace('/[\s]+/', " ", $str); // remove multiple space --> one space
        $str = str_replace(' ', '-', $str);
        $str = mb_strtolower($str);
        return $str;
    }

    public static function getShortName($str)
    {
        $str = self::stripAccents($str);
        $str = self::removeNonAlphaNumberic($str, " ");
        $str = preg_replace('/[\s]+/', " ", $str); // remove multiple space --> one space
        //$str = str_replace(' ', '-', $str);
        //$str = mb_strtolower($str);
        return $str;
    }


    public static function createKeywords($str)
    {
        $res = "";
        $res .= $str . ";";
        $res .= Utils::stripAccents($str) . ";";
        $res .= str_replace(" ", "", $str) . ";";
        $res .= str_replace(" ", "", Utils::stripAccents($str));

        return $res;

    }

}
