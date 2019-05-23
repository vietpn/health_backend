<?php

namespace App\Console\Commands;

use App\Models\BaseModel;
use App\Models\Post;
use App\User;
use Illuminate\Console\Command;
use Elasticsearch;

class PostSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post-sync:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync data post from mysql to elasticsearch';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = Elasticsearch\ClientBuilder::create()->build();
        $mappings = ['index' => 'post_index'];
//        $client->indices()->delete($mappings);
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
                                ],
                                'pin.id' => [
                                    'type' => 'integer',
                                ],
                                'pin.name' => [
                                    'type' => 'string',
                                ],
                                'pin.avatar' => [
                                    'type' => 'string',
                                ],
                                'pin.point' => [
                                    'type' => 'integer',
                                ],
                            ]
                        ]
                    ]
                ]
            ];
//        //add mapping
            $response = $client->indices()->create($params);

        }

        //get all post in 3p
        $start = date('Y-m-d H:i:s', strtotime('-3 minutes '));
        $end = date('Y-m-d H:i:s');
//        $posts = Post::where('updated_at', '>=', $start)
//            ->where('updated_at', '<=', $end)
//            ->where('is_deleted', NOT_DELETE)
//            ->orderBy('id', SORT_DESC)->get();
        $posts = Post::where('is_deleted', NOT_DELETE)
            ->orderBy('id', SORT_DESC)->get();
        try {
            if ($posts) {
                $bar = $this->output->createProgressBar($posts->count());
                foreach ($posts as $indexed) {
                    $this->info("\nInsert to Els: " . $indexed->id);
                    $item = [];
                    $item['id'] = $indexed->id;
                    $item['content'] = $indexed->content;
                    $item['photo'] = $indexed->photo;
                    $item['location'] = [
                        'lat' => (double)$indexed->latitude,
                        'lon' => (double)$indexed->longitude,
                    ];
                    $item['localtion_string'] = $indexed->location_string;
                    if($indexed->longitude >0  && $indexed->latitude >0){
                        $address = BaseModel::getAddressPost((double)$indexed->longitude, (double)$indexed->latitude);
                        if (isset($address)) {

                            $provice = isset($address->address_components[3]) ? $address->address_components[3] : "";
                            $district = isset($address->address_components[2]) ? $address->address_components[2] : "";
                            $item['province'] = isset($provice->long_name) ? $provice->long_name : "";
                            $item['district'] = isset($district->long_name) ? $district->long_name : "";
                            $item['location_string'] = isset($address->formatted_address) ? $address->formatted_address : "";
                            $indexed->update([
                                'province' => $item['province'],
                                'district' => $item['district'],
                                'location_string' => $item['location_string'],
                            ]);
                        }
                    }

                    $item['created_at'] = $indexed->created_at;
                    $item['updated_at'] = $indexed->updated_at;
                    $item['posted_day'] = $indexed->created_at;
                    $item['number_like'] = isset($indexed->postLikes) ? $indexed->postLikes()->count() : 0;
                    $item['number_comment'] = isset($indexed->postComments) ? $indexed->postComments()->count() : 0;
                    $item['number_view'] = isset($indexed->postViews) ? $indexed->postViews()->count() : 0;
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
                        /*if ($profile->gender == 1 || $profile->gender == -1) {
                            if ($profile->avatar_path == "") {
                                $avatar_path = env('APP_URL', '') . AVATAR_MEN;
                            }
                            $img = env('APP_URL', '') . MEN;
                        } elseif ($profile->gender == 0) {
                            $img = env('APP_URL', '') . WOMENT;
                            if ($profile->avatar_path == "") {
                                $avatar_path = env('APP_URL', '') . AVATAR_WOMENT;
                            }
                        }*/
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
                    $bar->advance();
                }
                $bar->finish();
            } else {
                $this->info("\nKhong co ban ghi de update!");
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }


    }

    public function getAddress($long, $lat)
    {
        $curl = new \Curl\Curl();
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $lat . ',' . $long . '&sensor=true';
        $response = $curl->get($url);
        $rep = json_decode($response->response)->results;
        return isset($rep[0]) ? ($rep[0]->formatted_address) : "";
    }
}
