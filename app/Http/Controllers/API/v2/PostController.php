<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Requests\API\CreatePostAPIRequest;
use App\Http\Requests\API\UpdatePostAPIRequest;
use App\Models\BaseModel;
use App\Models\Pin;
use App\Models\Post;
use App\Models\ProfileHistory;
use App\Models\ProfilePinHistory;
use App\Repositories\Api\PostRepository;
use App\Repositories\Api\ProfileRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Input;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Validator;

/**
 * Class PostController
 * @package App\Http\Controllers\API
 */
class PostController extends AppBaseController
{
    /** @var  PostRepository */
    private $postRepository;
    private $profileRepository;

    public function __construct(PostRepository $postRepo, ProfileRepository $profileRepository)
    {
        $this->postRepository = $postRepo;
        $this->profileRepository = $profileRepository;
    }

    /**
     * Display a listing of the Post.
     * GET|HEAD /posts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $profile = \Auth::user();
        $this->postRepository->pushCriteria(new RequestCriteria($request));
        $this->postRepository->pushCriteria(new LimitOffsetCriteria($request));

        $posts = $this->postRepository->findByField('profile_id', $profile->id);
        $result = $posts->toArray();
        return $this->sendResponse($result, 'Posts retrieved successfully', count($result));
    }

    /**
     * Store a newly created Post in storage.
     * POST /posts
     *
     * @param CreatePostAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePostAPIRequest $request)
    {
        $profile = \Auth::user();

        $input = $request->all();
        $input['profile_id'] = $profile->id;

        // check point of pin
        if (isset($input['pin_id'])) {
            $pin = Pin::where('id', '=', $input['pin_id'])->get()[0];
            //Check this pin was buying?
            $pinHis = ProfilePinHistory::select('pin_id')->where('profile_id',$profile->id)->distinct()->pluck('pin_id')->toArray();

            if (!empty($pin) && !in_array($pin->id, $pinHis)) {
                $respone = $this->profileRepository->transferPoint(DEDUCTION_POINT, $profile->id, $pin->point);

                if (!isset($respone) || $respone['success'] === false) {
                    return $this->sendError('Tài khoản không đủ tiền', CODE_BAD_REQUEST);
                }

                //Save to history buying
                $profileHis = new ProfileHistory();
                $profileHis->profile_id = $profile->id;
                $profileHis->item_id = $input['pin_id'];
                $profileHis->point = $pin->point;
                $profileHis->type = BUY_PIN;
                $profileHis->save();

            }
        }

        $posts = $this->postRepository->create($input);
        //Save to history using Pin
        if (isset($posts) && isset($pin)) {
            $profilePinHis = new ProfilePinHistory();
            $profilePinHis->profile_id = $profile->id;
            $profilePinHis->pin_id = $input['pin_id'];
            $profilePinHis->post_id = $posts->id;
            $profilePinHis->point = $pin->point;
            $profilePinHis->save();
        }

        //lấy dữ liệu trả về
        $posts['location']= [
            'lat'   =>  $posts->latitude,
            'lon'   =>  $posts->longitude,
        ];
        unset($posts['latitude']);
        unset($posts['longitude']);
        unset($posts['updated_at']);
        $postLike = $profile->getLike()->where('post_id', intval($posts->id))->count();
        $post['is_like'] = (isset($postLike) && $postLike > 0) ? true : false;

        $post['likes'] = $posts->postLikes()->get();

        $postFavorite = $profile->getFavorite()->where('post_id', intval($posts->id))->count();
        $posts['is_favorite_post'] = (isset($postFavorite) && $postFavorite > 0) ? true : false;

        $posts['favorites_post'] = $posts->postFavorites()->get();

        $posts['views'] = $posts->postViews()->get();
        $posts['comments'] = $posts->postComments()->get();

        $posts['number_likes'] = $posts->postLikes()->count();
        $posts['number_views'] = $posts->postViews()->count();
        $posts['number_comments'] = $posts->postComments()->count();
        $dataProfile = [];
        if (isset($posts->profile)) {
            $dataProfile = [
                'id' => isset($posts->profile) ? $posts->profile->id : "",
                'avatar' => isset($posts->profile) ? $posts->profile->avatar_path : "",
                'name' => isset($posts->profile) ? $posts->profile->name : "",
                'location_string' => isset($posts->profile) ? $posts->profile->location : "",
                'longitude' => isset($post->profile) ? $posts->profile->longitude : "",
                'latitude' => isset($posts->profile) ? $posts->profile->latitude : "",
            ];
        }
        $posts['profile_infor'] = $dataProfile;
        $posts['pin'] = $posts->pin()->first();
        if (isset($posts['profile'])) {
            unset($posts['profile']);
        }
        return $this->sendResponse($posts->toArray(), 'Post saved successfully');
    }

    /**
     * Display the specified Post.
     * GET|HEAD /posts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {

        /** @var Post $post */
        $post = $this->postRepository->findWithoutFail($id);
        if (empty($post)) {
            return $this->sendError('Post not found', CODE_NOT_FOUND);
        }
        $profile = \Auth::user();
        $postLike = $profile->getLike()->where('post_id', intval($id))->count();
        $post['is_like'] = (isset($postLike) && $postLike > 0) ? true : false;

        $post['likes'] = $post->postLikes()->get();

        $postFavorite = $profile->getFavorite()->where('post_id', intval($id))->count();
        $post['is_favorite_post'] = (isset($postFavorite) && $postFavorite > 0) ? true : false;

        $post['favorites_post'] = $post->postFavorites()->get();

        $post['views'] = $post->postViews()->get();
        $post['comments'] = $post->postComments()->get();

        $post['number_likes'] = $post->postLikes()->count();
        $post['number_views'] = $post->postViews()->count();
        $post['number_comments'] = $post->postComments()->count();
        $dataProfile = [];
        if (isset($post->profile)) {
            $dataProfile = [
                'id' => isset($post->profile) ? $post->profile->id : "",
                'avatar' => isset($post->profile) ? $post->profile->avatar_path : "",
                'name' => isset($post->profile) ? $post->profile->name : "",
                'location_string' => isset($post->profile) ? $post->profile->location : "",
                'longitude' => isset($post->profile) ? $post->profile->longitude : "",
                'latitude' => isset($post->profile) ? $post->profile->latitude : "",
            ];
        }
        $post['profile_infor'] = $dataProfile;
        $post['pin'] = $post->pin()->first();
        if (isset($post['profile'])) {
            unset($post['profile']);
        }
        return $this->sendResponse($post->toArray(), 'Post retrieved successfully');
    }

    /**
     * Update the specified Post in storage.
     * PUT/PATCH /posts/{id}
     *
     * @param  int $id
     * @param UpdatePostAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostAPIRequest $request)
    {
        $profile = \Auth::user();
        $input = $request->all();

        /** @var Post $post */
        $post = $this->postRepository->findWhere([
            'profile_id' => $profile->id,
            'id' => $id
        ]);

        if (empty($post) || !isset($post[0])) {
            return $this->sendError('Post not found', CODE_NOT_FOUND);
        }

        $post = $this->postRepository->update($input, $id);

        return $this->sendResponse($post->toArray(), 'Post updated successfully');
    }

    /**
     * Remove the specified Post from storage.
     * DELETE /posts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $profile = \Auth::user();
        //$post = $this->postRepository->findWithoutFail($id);
        /** @var Post $post */
        $post = $this->postRepository->findWhere([
            'profile_id' => $profile->id,
            'id' => $id
        ]);


        if (empty($post) || !isset($post[0])) {
            return $this->sendError('Post not found', CODE_NOT_FOUND);
        }

        // update status deleted
        $this->postRepository->update(['is_deleted' => STATUS_DELETED], $id);

        return $this->sendResponse($id, 'Post deleted successfully');
    }

    /**
     * @param $userId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postByUser($userId, Request $request)
    {
        $this->postRepository->pushCriteria(new RequestCriteria($request));
        $this->postRepository->pushCriteria(new LimitOffsetCriteria($request));

        $posts = $this->postRepository->findByField('profile_id', $userId);
        $result = $posts->toArray();

        return $this->sendResponse($result, 'List Post by user', count($result));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchPost(Request $request)
    {

        $rules = Post::$rulesSearchPost;
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendError($validator->messages(), CODE_NOT_FOUND);
        }
        $respone = $this->postRepository->searchPost($request);
        if ($respone === false || !isset($respone['data'])) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }

        return $this->sendResponse($respone['data'], MSG_SUCCESS);

    }
}
