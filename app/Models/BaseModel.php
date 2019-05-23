<?php

namespace App\Models;

use Elasticsearch;
use App\Models\Post;
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

    const TYPE_BILLING_VALIDATE = 1; //validate billing android kieu
    const TYPE_BILLING_VALIDATESUB = 2; //validate billing android kieu

    const TYPE_CATEGORY_NORMAL = 1;
    const TYPE_CATEGORY_FUTURE = 2;
    const TYPE_CATEGORY_SPECIAL = 3;

    const ITEM_POSITION_FULL = 0;
    const ITEM_POSITION_HEADER = 1;
    const ITEM_POSITION_BODY = 2;
    const ITEM_POSITION_FACE = 3;   //Mặt
    const ITEM_POSITION_EAR = 4;    //Tai
    const ITEM_POSITION_COAT = 5;   //Áo khoác
    const ITEM_POSITION_TROUSERS = 6;   //Cái quần
    const ITEM_POSITION_LEFT_HAND = 7;  //Tay trái
    const ITEM_POSITION_RIGHT_HAND = 8;  //Tay phải
    const ITEM_POSITION_LEFT_LEG = 9;  //Chân trái
    const ITEM_POSITION_RIGHT_LEG = 10;  //Chân phải


    const POINT_CONFIG_CHAT_SEND = 'POINT_CHAT_SEND';
    const POINT_CONFIG_CHAT_RECEIVE = 'POINT_CHAT_REPLY';
    const POINT_CONFIG_SEARCH = 'POINT_SEARCH';
    const POINT_CONFIG_LOGIN = 'POINT_LOGIN';
    const POINT_CONFIG_EDIT_PROFILE = 'POINT_EDIT_PROFILE';

    const NGWORD_TYPE_ALL = 0;   //All post & chat
    const NGWORD_TYPE_POST = 1;  //Post (local stream)
    const NGWORD_TYPE_CHAT = 2;  //Chat

    public static function getNgWordTypeList()
    {
        return [
            self::NGWORD_TYPE_ALL => 'All Post&Chat',
            self::NGWORD_TYPE_POST => 'Only Post',
            self::NGWORD_TYPE_CHAT => 'Only Chat',
        ];
    }

    public static function getNgWordTypeName($status)
    {
        $arr = BaseModel::getNgWordTypeList();
        if (isset($arr[$status])) {
            return $arr[$status];
        } else {
            return "N/A";
        }
    }


    public static function getPointConfigList()
    {
        return [
            self::POINT_CONFIG_CHAT_SEND => 'Point Chat Send(-)',
            self::POINT_CONFIG_CHAT_RECEIVE => 'Point Chat Reply(+)',
            self::POINT_CONFIG_SEARCH => 'Point Search(-)',
            self::POINT_CONFIG_LOGIN => 'Point Login(+)',
            self::POINT_CONFIG_EDIT_PROFILE => 'Point Edit Profile(-)',
        ];
    }

    public static function getPointConfigName($status)
    {
        $arr = BaseModel::getPointConfigList();
        if (isset($arr[$status])) {
            return $arr[$status];
        } else {
            return "N/A";
        }
    }

    public static function getPositionList()
    {
        return [
            self::ITEM_POSITION_FULL => 'Full',
            self::ITEM_POSITION_HEADER => 'Header',
            self::ITEM_POSITION_BODY => 'Body',
            self::ITEM_POSITION_FACE => 'Face',
            self::ITEM_POSITION_EAR => 'Ear',
            self::ITEM_POSITION_COAT => 'Coat',
            self::ITEM_POSITION_TROUSERS => 'Trousers',
            self::ITEM_POSITION_LEFT_HAND => 'Left Hand',
            self::ITEM_POSITION_RIGHT_HAND => 'Right Hand',
            self::ITEM_POSITION_LEFT_LEG => 'Left Leg',
            self::ITEM_POSITION_RIGHT_LEG => 'Right Leg',
        ];
    }

    public static function getPositionName($status)
    {
        $arr = BaseModel::getPositionList();
        if (isset($arr[$status])) {
            return $arr[$status];
        } else {
            return "N/A";
        }
    }

    public static function getCategoryTypeList()
    {
        return [
            self::TYPE_CATEGORY_NORMAL => 'Normal',
            self::TYPE_CATEGORY_FUTURE => 'Future',
            self::TYPE_CATEGORY_SPECIAL => 'Special',
        ];
    }

    public static function getCategoryTypeName($status)
    {
        $arr = BaseModel::getCategoryTypeList();
        if (isset($arr[$status])) {
            return $arr[$status];
        } else {
            return "N/A";
        }
    }

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

    public static function getImage($src, $width = 80, $height = 80)
    {
        if (empty($src)) {
            return "http://placehold.it/" . $width . "x" . $height;
        }
        return 'storage/' . $src;
    }

    public static function getSubStringTrack($str, $lenght = 50)
    {
        if (strlen($str) > $lenght) {
            $str = substr($str, 0, $lenght) . ' .....';
        }
        return $str;
    }

    public static function getAddress($long, $lat)
    {
        $curl = new \Curl\Curl();
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $lat . ',' . $long . '&sensor=true&language=ja';
        $response = $curl->get($url);
        $rep = json_decode($response->response)->results;
        return isset($rep[0]) ? ($rep[0]->formatted_address) : "";
    }

    public static function getAddressPost($long, $lat)
    {
        $curl = new \Curl\Curl();
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $lat . ',' . $long . '&sensor=true&language=ja';
        $response = $curl->get($url);
        $rep = json_decode($response->response)->results;
        return isset($rep[0]) ? ($rep[0]) : "";
    }

    public static function updateElastichsearchPost($id)
    {
        $client = Elasticsearch\ClientBuilder::create()->build();
        $mappings = ['index' => 'post_index'];
        if (!$client->indices()->exists($mappings)) {
            $params = [
                'index' => 'post_index',
                'body' => [
                    'mappings' => [
                        'post' => [
                            '_source' => [
                                'enabled' => true
                            ],
                            'properties' => [
                                'content' => [
                                    'type' => 'string',
                                ],
                                'photo' => [
                                    'type' => 'string'
                                ],
                                'location' => [
                                    'doc_values' => true,
                                    'type' => 'geo_point'
                                ],
                                'profile.avatar' => [
                                    'type' => 'string',
                                ]
                            ]
                        ]
                    ]
                ]
            ];
//        //add mapping
            $response = $client->indices()->create($params);

        }
        //get all post in 3p
        $indexed = Post::find($id);
        try {
            if ($indexed) {
                $item = [];
                $item['id'] = $indexed->id;
                $item['content'] = $indexed->content;
                $item['photo'] = $indexed->photo;
                $item['location'] = [
                    'lat' => (double)$indexed->latitude,
                    'lon' => (double)$indexed->longitude,
                ];
                $item['localtion_string'] = $indexed->location_string;
                $item['province'] = $indexed->province;
                $item['district'] = $indexed->district;
                $item['number_like'] = isset($indexed->postLikes) ? $indexed->postLikes()->count() : 0;
                $item['number_comment'] = isset($indexed->postComments) ? $indexed->postComments()->count() : 0;
                $item['number_view'] = isset($indexed->postViews) ? $indexed->postViews()->count() : 0;
                $item['created_at'] = $indexed->created_at;
                $item['updated_at'] = $indexed->updated_at;
                $item['posted_day'] = $indexed->created_at;
                $pin = $indexed->pin()->first();
                $item['pin'] = [
                    'id' => isset($pin) ? (int)$pin->id : "",
                    'name' => isset($pin) ? $pin->name : "",
                    'avatar' => isset($pin) ? $pin->avatar : "",
                    'point' => isset($pin) ? (int)$pin->point : 0,
                ];
                $profile = $indexed->profile()->first();
                $dataProfile = [];
                if (isset($profile)) {
                    $avatar_path = $profile->avatar_path;
                    if ($profile->is_business == PROFILE_DEFAULT) {

                        $gender = isset($profile->getProfileUsers->gender) ? (int)$profile->getProfileUsers->gender : "";
                        $birth_year = (int)isset($profile->getProfileUsers->birth_year) ? (int)$profile->getProfileUsers->birth_year : "";
                        $img = env('APP_URL', '') . MEN;
                        if ($profile->gender == 1 || $profile->gender == -1) {
                            if ($profile->avatar_path == "") {
                                $avatar_path = env('APP_URL', '') . AVATAR_MEN;
                            }
                            $img = env('APP_URL', '') . MEN;
                        } elseif ($profile->gender == 0) {
                            $img = env('APP_URL', '') . WOMENT;
                            if ($profile->avatar_path == "") {
                                $avatar_path = env('APP_URL', '') . AVATAR_WOMENT;
                            }
                        }
                    } elseif ($profile->is_business == PROFILE_BUSSINESS) {
                        $gender = "";
                        $birth_year = "";
                        $img = env('APP_URL', '') . SHOP;
                        if ($profile->avatar_path == "") {
                            $avatar_path = env('APP_URL', '') . SHOP;
                        }
                    }
                    $dataProfile = [
                        'id' => $indexed->profile_id,
                        'name' => $profile->name,
                        'gender' => $gender,
                        'birth_year' => $birth_year,
                        'current_location' => $profile->location,
                        'img' => isset($img) ? $img : "",
                        'avatar' => $avatar_path,
                        'location' => [
                            'lat' => (double)$profile->latitude,
                            'lon' => (double)$profile->longitude,
                        ]
                    ];
                }
                $item['profile'] = $dataProfile;
                $params = [];
                $params['body'] = $item;
                $params['index'] = 'post_index';
                $params['type'] = 'post';
                $params['id'] = $indexed->id;
                $client->index($params);

            } else {

            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function updateProfileElasticsearch($id)
    {
        $client = Elasticsearch\ClientBuilder::create()->build();
        $indexed = User::find($id);;
        try {
            if ($indexed) {
                $item = [];
                $item['id'] = $indexed->id;
                $item['name'] = $indexed->name;
                $item['is_business'] = (int)$indexed->is_business;
                $item['current_location'] = $indexed->location;
                $item['online_status'] = $indexed->online_status;
                $item['avatar_path'] = $indexed->avatar_path;
                $item['img'] = $indexed->img;
                $item['created_at'] = $indexed->created_at;
                $item['updated_at'] = $indexed->updated_at;
                if ($indexed->is_business == PROFILE_DEFAULT) {

                    $item['gender'] = isset($indexed->getProfileUsers->gender) ? (int)$indexed->getProfileUsers->gender : "";
                    $item['birth_year'] = (int)isset($indexed->getProfileUsers->birth_year) ? (int)$indexed->getProfileUsers->birth_year : "";
                } elseif ($indexed->is_business == PROFILE_BUSSINESS) {
                    $item['gender'] = "";
                    $item['birth_year'] = "";
                }

                $item['location'] = [
                    'lat' => (double)$indexed->latitude,
                    'lon' => (double)$indexed->longitude,
                ];
                $params = [];
                $params['body'] = $item;
                $params['index'] = 'profile_index';
                $params['type'] = 'profile';
                $params['id'] = $indexed->id;
                $client->index($params);
            } else {
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     *
     * @param $id
     * @return string
     */
    public static function deletePostElasticsearch($id)
    {
        $client = Elasticsearch\ClientBuilder::create()->build();
        $mappings = ['index' => 'post_index'];
        if (!$client->indices()->exists($mappings)) {
            $params = [
                'index' => 'post_index',
                'body' => [
                    'mappings' => [
                        'post' => [
                            '_source' => [
                                'enabled' => true
                            ],
                            'properties' => [
                                'content' => [
                                    'type' => 'string',
                                ],
                                'photo' => [
                                    'type' => 'string'
                                ],
                                'location' => [
                                    'doc_values' => true,
                                    'type' => 'geo_point'
                                ],
                                'profile.avatar' => [
                                    'type' => 'string',
                                ]
                            ]
                        ]
                    ]
                ]
            ];
//        //add mapping
            $response = $client->indices()->create($params);

        }
        //get all post in 3p
        $indexed = Post::find($id);
        try {
            if ($indexed) {
                $params['index'] = 'post_index';
                $params['type'] = 'post';
                $params['id'] = $indexed->id;
                $client->delete($params);

            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return string
     */
    public static function deleteProfileElasticsearch($id)
    {
        $client = Elasticsearch\ClientBuilder::create()->build();
        $mappings = ['index' => 'post_index'];
        if (!$client->indices()->exists($mappings)) {
            $params = [
                'index' => 'post_index',
                'body' => [
                    'mappings' => [
                        'post' => [
                            '_source' => [
                                'enabled' => true
                            ],
                            'properties' => [
                                'content' => [
                                    'type' => 'string',
                                ],
                                'photo' => [
                                    'type' => 'string'
                                ],
                                'location' => [
                                    'doc_values' => true,
                                    'type' => 'geo_point'
                                ],
                                'profile.avatar' => [
                                    'type' => 'string',
                                ]
                            ]
                        ]
                    ]
                ]
            ];
//        //add mapping
            $response = $client->indices()->create($params);

        }
        //get all post in 3p
        $indexed = User::find($id);
        try {
            if ($indexed) {
                $params['index'] = 'profile_index';
                $params['type'] = 'profile';
                $params['id'] = $indexed->id;
                $client->delete($params);

            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}