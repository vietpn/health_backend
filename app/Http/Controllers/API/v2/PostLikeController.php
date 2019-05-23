<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Requests\API\CreatePostLikeAPIRequest;
use App\Models\BaseModel;
use App\Models\PostLike;
use App\Repositories\Api\PostLikeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Validator;

/**
 * Class PostLikeController
 * @package App\Http\Controllers\API\V2
 */
class PostLikeController extends AppBaseController
{
    /** @var  PostLikeRepository */
    private $postLikeRepository;

    public function __construct(PostLikeRepository $postLikeRepo)
    {
        $this->postLikeRepository = $postLikeRepo;
    }

    /**
     * Display a listing of the PostLike.
     * GET|HEAD /postLikes
     *
     * @param  int $postId
     * @param Request $request
     * @return Response
     */
    public function index($postId, Request $request)
    {
        $this->postLikeRepository->pushCriteria(new RequestCriteria($request));
        $this->postLikeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $postLikes = $this->postLikeRepository->findByField('post_id', $postId);
        $result = $postLikes->toArray();

        return $this->sendResponse($result, 'Post Likes retrieved successfully', count($result));
    }

    /**
     * Store a newly created PostLike in storage.
     * POST /postLikes
     *
     * @param  int $postId
     * @param CreatePostLikeAPIRequest $request
     *
     * @return Response
     */
    public function store($postId, CreatePostLikeAPIRequest $request)
    {
        $profile = \Auth::user();
        $input = $request->all();
        $input['profile_id'] = $profile->id;
        $input['post_id'] = $postId;

        $validator = Validator::make($input, [
            'post_id' => 'required|integer|exists:e_post,id|unique_with:e_post_like,profile_id,' . $input['profile_id']
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->messages(), CODE_NOT_FOUND);
        }

        $postLikes = $this->postLikeRepository->create($input);

        return $this->sendResponse($postLikes->toArray(), 'Post Like saved successfully');
    }

    /**
     * Remove the specified PostLike from storage.
     * DELETE /postLikes/{id}
     *
     * @param  int $postId
     *
     * @return Response
     */
    public function destroy($postId)
    {
        $profile = \Auth::user();

        /** @var PostLike $postLike */
        $postLike = $this->postLikeRepository->findWhere([
            'profile_id' => $profile->id,
            'post_id' => $postId,
        ]);


        if (empty($postLike)|| !isset($postLike[0])) {
            return $this->sendError('Post Like not found', CODE_NOT_FOUND);
        }

        $postLike[0]->delete();
        //$this->postLikeRepository->update(['is_deleted' => STATUS_DELETED], $postLike[0]->id);

        return $this->sendResponse($postId, 'Post Like deleted successfully');
    }
}
