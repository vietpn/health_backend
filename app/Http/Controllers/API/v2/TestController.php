<?php
/**
 * Created by PhpStorm.
 * User: tienmx
 * Date: 8/5/2017
 * Time: 3:05 PM
 */

namespace App\Http\Controllers\API\v2;

use App\Define\Systems;
use App\Http\Requests\API\CreatePostAPIRequest;
use App\Http\Requests\API\UpdatePostAPIRequest;
use App\Models\BaseModel;
use App\Models\Pin;
use App\Models\Post;
use App\Repositories\Api\PostRepository;
use App\Repositories\Api\ProfileRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Input;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Validator;


class TestController extends AppBaseController
{
    /** @var  PostRepository */
    private $postRepository;
    private $profileRepository;

    public function __construct(PostRepository $postRepo, ProfileRepository $profileRepository)
    {
        $this->postRepository = $postRepo;
        $this->profileRepository = $profileRepository;
    }

    public function store(Request $request)
    {
        $temp = $request->all();
        \Log::info($temp, ['LOG_REQUEST_UPLOAD_IMG' => 1]);
        if (!empty($request['photo'])) {
            $photo_path = Systems::uploadPhoto(
                $request['photo'],
                'post/photo' . DIRECTORY_SEPARATOR . date("Y/m/d/H")
            );
            $temp['photo'] = ($photo_path) ? 'http://eyeland.timesfun.jp/storage/' . $photo_path : null;
        }
        \Log::info($temp, ['LOG_RESOPONE_UPLOAD_IMG' => 1]);
        return $temp;

    }
    public function updateLocationPost(){

        $posts = Post::where('is_deleted', NOT_DELETE)
            ->orderBy('id', SORT_DESC)->get();
        foreach ($posts as $item) {
            $localtionString = BaseModel::getAddress((double)$item->longitude, (double)$item->latitude);
            if (!is_null($localtionString)) {
                $item->location_string = $localtionString;
                $item->save();
            }
        }
    }
    public function getAddress()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://maps.googleapis.com/maps/api/geocode/json?latlng=35.7704037477811%2C139.7275311764144&sensor=true",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 5eb82561-319b-16da-51f2-37887283706a"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            dd($response) ;
        }
//        $curl = new \Curl\Curl();
//        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=35.7704037477811,139.7275311764144&sensor=true';
//        $response = $curl->get($url);
//        $rep = json_decode($response->response)->results;
//        return isset($rep[0]) ? ($rep[0]->formatted_address) : "";
    }
}