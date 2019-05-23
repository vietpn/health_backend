<?php

namespace App\Repositories\Api;

use App\Define\Systems;
use App\Models\BaseModel;
use App\Models\Post;
use App\Models\PostLike;
use InfyOm\Generator\Common\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\ImageManagerStatic as Image;
use Elasticsearch;

class PostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'profile_id',
        'content',
        'photo',
        'pin_id',
        'longitude',
        'latitude',
        'is_deleted',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Post::class;
    }

    /**
     * @inheritdoc
     */
    public function create(array $attributes)
    {
        /*if (!empty($attributes['photo'])) {
            $photo_path = Systems::uploadPhoto(
                $attributes['photo'],
                'post/photo' . DIRECTORY_SEPARATOR . date("Y/m/d/H")
            );
            $attributes['photo'] = ($photo_path) ? $photo_path : null;
        }*/
        $image = $attributes['photo'];
        if (isset($image)) {

            $file = 'post/photo' . DIRECTORY_SEPARATOR . date("Y/m/d/H");
            $avatar_name = time() . '.jpg';
            $avatar_path = Systems::uploadBasse64($image, $file, $avatar_name);
            if ($avatar_path) {
                $attributes['photo'] = $avatar_path;
            }
        }
        //get location
        if (!empty($attributes['latitude']) && !empty($attributes['longitude'])) {
            $address = BaseModel::getAddressPost($attributes['longitude'], $attributes['latitude']);
            if (isset($address)) {

                $provice = isset($address->address_components[3]) ? $address->address_components[3] : "";
                $district = isset($address->address_components[2]) ? $address->address_components[2] : "";
                $attributes['province'] = isset($provice->long_name)?$provice->long_name:"";
                $attributes['district'] = isset($district->long_name)?$district->long_name:"";
                $attributes['location_string'] = isset($address->formatted_address) ? $address->formatted_address : "";
            }
        }
        return parent::create($attributes);

    }


    /**
     * @inheritdoc
     */
    public function update(array $attributes, $id)
    {
        if (!empty($attributes['photo'])) {
            $photo_path = Systems::uploadPhoto(
                $attributes['photo'],
                'post/photo' . DIRECTORY_SEPARATOR . date("Y/m/d/H")
            );
            $attributes['photo'] = ($photo_path) ? $photo_path : null;
        }

        return parent::update($attributes, $id);
    }

    /**
     * @param $request
     */
    public function searchPost($request)
    {
        $user = \Auth::user();
        $topLeftLat = $request->get('top_left_lat', 0);
        $topLeftLon = $request->get('top_left_lon', 0);
        $bottomRightLat = $request->get('bottom_right_lat', 0);
        $bottomRightLon = $request->get('bottom_right_lon', 0);
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 15);
        $pageSearch = ($page == 1) ? 0 : ($page - 1) * $limit;
        $client = Elasticsearch\ClientBuilder::create()->build();
        $params = [];
        $params['index'] = 'post_index';
        $params['type'] = 'post';
        $params['body'] = [
            'query' => [
                'bool' => [
                    'filter' => [
                        'geo_bounding_box' => [
                            'location' => [
                                'top_left' => [
                                    'lat' => $topLeftLat,
                                    'lon' => $topLeftLon
                                ],
                                'bottom_right' => [
                                    'lat' => $bottomRightLat,
                                    'lon' => $bottomRightLon
                                ],
                            ]
                        ]
                    ],
                ]
            ],
            "sort" => [
                [
                    'id' => [
                        'order' => 'desc',
                    ]
                ]

            ],
            "from" => $pageSearch,
            "size" => intval($limit),
        ];
        $temp = [];
        $respone = $client->search($params);
        if (isset($respone['hits']['hits'])) {
            $profiles = $respone['hits']['hits'];

            foreach ($profiles as $item) {
                $te = $item['_source'];
                //check xem user đó đã like hay chưa
                $profileId = (int)isset($te['profile']['id']) ? $te['profile']['id'] : 0;
                $postId = (int)isset($te['id']) ? $te['id'] : 0;
                $postLike = PostLike::where('profile_id', $user->id)
                    ->where('post_id', $postId)->first();
                $te['is_like'] = (count($postLike) > 0) ? true : false;
                $temp[] = $te;
            }
        }
        return [
            'success' => true,
            'data' => [
                'items' => $temp,
                'total' => count($temp),
            ],
        ];

    }
}
