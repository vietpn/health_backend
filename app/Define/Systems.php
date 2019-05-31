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
    const PAGES_NUM = 5;
    const TIME_CACHE = 10;//cache 10 phút
    const LEFT = 1;//vị trí menu bên trái
    const RIGHT = 2;//vị trí menu bên phải
    const ACTIVE = 1;//hoạt động
    const LOGO_FIRST = 'assets/frontend/images/logo_1.png';
    const LOGO_SECOND = 'assets/frontend/images/logo_2.png';
    const SORT_DESC = 'desc';
    const SORT_ASC = 'asc';
    const SLUG_TIEN_LEN_MIEN_NAM = 'tien-len-mien-nam';
    const SLUG_BA_CAY_GA = 'ba-cay-ga';
    const SLUG_BA_CAY_CHUONG = 'ba-cay-chuong';
    const TOKEN = 'V$2F511FEF4EAFE138791DB';
    const THREE_MONTHS = 3;//tháng
    const SIX_MONTHS = 6;//tháng
    const ONE_YEAR = 12;//1 năm
    const CACHE_RANK = 'cache_rank';
    const CACHE_RANK_TIME = 'cache_rank_time';

    /**
     * @param $key
     * @param $value
     */
    public static function _setRedis($key, $value)
    {
        \Redis::set($key, $value);
    }

    public static function getSetTime()
    {
        return [
            self::THREE_MONTHS => '3 months',
            self::SIX_MONTHS => '6 months',
            self::ONE_YEAR => '1 Years',
        ];
    }

    /**
     * @param $key
     * @return bool|string
     */
    public static function _getRedis($key)
    {
        return \Redis::get($key);
    }

    # const
    public static function getStr($str)
    {
        return strlen($str) > 200 ? mb_substr($str, 0, 200) . '...' : $str;

    }

    public static function getActiveMenu($source, array $target)
    {
        foreach ($target as $key => $value) {
            $arr = explode("/", $source);
            if (in_array($value, $arr)) {
                echo ' active';
            }
        }

    }

    public static function callApi($url, $params = null)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $params,
                CURLOPT_TIMEOUT => 180,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array(
                    'token:' . self::TOKEN
                )
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }

    public static function formatPrice($price, $decimal = 2)
    {

        if ($price == '' || $price == 0)
            return '0';
        return number_format($price, $decimal, '.', ',');
    }

    public static function uploadPhoto($attrPhoto, $file)
    {
        $photo = Image::make($attrPhoto);

        $root = storage_path(STORAGE_PATH);
        $path = $root . DIRECTORY_SEPARATOR . $file;
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        // save photo
        $photoName = time() . '.jpg';
        $fullPath = $path . DIRECTORY_SEPARATOR . $photoName;
        $photoPath = $file . DIRECTORY_SEPARATOR . $photoName;

        if (!$photo->save($fullPath)) {
            return false;
        }

        return $photoPath;
    }

    public static function mapAttribute($requestAll, $attribute)
    {
        $arrRequest = [];
        foreach ($requestAll as $key => $item) {
            array_push($arrRequest, $key);
        }

        $requestMap = array_unique(array_merge($arrRequest, $attribute));
        if (count($requestMap) != count($attribute)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     *  Generate Transaction follow string
     * @param $str
     * @return string
     */
    public static function generateTransaction($str)
    {
        return sha1($str . microtime(true) . uniqid(rand(), true));
    }

    public static function getPlcaeByName($name)
    {

        try {
            $curl = curl_init();
            $name = urlencode($name);
            $url = "https://maps.googleapis.com/maps/api/place/textsearch/json?key=AIzaSyAfKawU1Gkc22-6lk6ehTJJmxoi2T4rALM&query=" . $name;
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,

            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                return $response;
            }
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public static function removeArrayValueNull($array)
    {
        $respone = array_filter($array, function ($value) {
            return ($value !== null) || ($value != "") || ($value != 0);
        });
        return $respone;
    }

    public static function uploadBasse64($attrPhoto, $file, $name)
    {
        $avatarPath = Image::make(file_get_contents($attrPhoto));
        $avatarPath->resize(300, 300);
        $root = storage_path(STORAGE_PATH);
        $path = $root . DIRECTORY_SEPARATOR . $file;
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        $full_path = $path . DIRECTORY_SEPARATOR . $name;
        $avatar_path = $file . DIRECTORY_SEPARATOR . $name;
        if (!$avatarPath->save($full_path)) {
            return false;
        }

        return $avatar_path;
    }

    public static function statusProfileHistory()
    {
        return [
            BUY_ITEM => 'アイテム購入',
            SEARCH => 'アカウント検索',
            CHAT => 'チャットする',
            GIVE_POINT => 'ポイントを渡す',
            PLUS_POINT_CHAT => 'チャットメッセージに返信する',
            PLUS_POINT_WHEN_GIVE => '与えられた POINT',
            PLUS_CARD_IAP_ANDROID => 'IAP ANDROID でチャージする',
            PLUS_CARD_IAP_IOS => 'IAP IOS でチャージする'
        ];
    }

    public static function statusDeduction()
    {
        return [BUY_ITEM, SEARCH, CHAT, GIVE_POINT];
    }

    public static function statusPlus()
    {
        return [PLUS_POINT_CHAT, PLUS_POINT_WHEN_GIVE, PLUS_CARD_IAP_ANDROID, PLUS_CARD_IAP_IOS];
    }

    public static function getAllRank()
    {
        if (Cache::has(self::CACHE_RANK)) {
            $respone = Cache::get(self::CACHE_RANK);
        } else {
            $respone = RankConfig::select('id', 'name', 'begin', 'end', 'time')
                ->orderBy('begin', SORT_DESC)->get()->toArray();
            Cache::put(self::CACHE_RANK, $respone, Systems::TIME_CACHE * 6 * 30);
        }
        return $respone;
    }

    public static function getTimeRank()
    {
        if (Cache::has(self::CACHE_RANK_TIME)) {
            $respone = Cache::get(self::CACHE_RANK_TIME);
        } else {
            $respone = RankConfig::select('time')->first()->toArray();
            Cache::put(self::CACHE_RANK, $respone, Systems::TIME_CACHE * 6 * 30);
        }
        return $respone;
    }
}