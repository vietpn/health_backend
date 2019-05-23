<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Requests\API\CreatePostCommentLikeAPIRequest;
use App\Models\PostCommentLike;
use App\Repositories\Api\PostCommentLikeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Validator;

/**
 * Class PostCommentLikeController
 * @package App\Http\Controllers\API\V2
 */
class PostCommentLikeController extends AppBaseController
{
    /** @var  PostCommentLikeRepository */
    private $postCommentLikeRepository;

    public function __construct(PostCommentLikeRepository $postCommentLikeRepo)
    {
        $this->postCommentLikeRepository = $postCommentLikeRepo;
    }

    /**
     * Display a listing of the PostCommentLike.
     * GET|HEAD /postCommentLikes
     *
     * @param  int $commentId
     * @param Request $request
     * @return Response
     */
    public function index($commentId, Request $request)
    {
        $this->postCommentLikeRepository->pushCriteria(new RequestCriteria($request));
        $this->postCommentLikeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $commentLikes = $this->postCommentLikeRepository->findByField('post_comment_id', $commentId);
        $result = $commentLikes->toArray();

        return $this->sendResponse($result, 'Post Comment Likes retrieved successfully', count($result));
    }

    /**
     * Store a newly created PostCommentLike in storage.
     * POST /postCommentLikes
     *
     * @param  int $commentId
     * @param CreatePostCommentLikeAPIRequest $request
     *
     * @return Response
     */
    public function store($commentId, CreatePostCommentLikeAPIRequest $request)
    {
        $profile = \Auth::user();
        $input = $request->all();
        $input['profile_id'] = $profile->id;
        $input['post_comment_id'] = $commentId;

        $validator = Validator::make($input, [
            'post_comment_id' => 'required|integer|exists:e_post_comment,id|unique_with:e_post_comment_like,profile_id,' . $input['profile_id']
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->messages(), CODE_INTERNAL_SERVER_ERROR);
        }

        $postCommentLikes = $this->postCommentLikeRepository->create($input);

        return $this->sendResponse($postCommentLikes->toArray(), 'Post Comment Like saved successfully');
    }

    /**
     * Remove the specified PostCommentLike from storage.
     * DELETE /postCommentLikes/{id}
     *
     * @param  int $commentId
     *
     * @return Response
     */
    public function destroy($commentId)
    {
        $profile = \Auth::user();

        /** @var PostCommentLike $postCommentLike */
        $postCommentLike = $this->postCommentLikeRepository->findWhere([
            'profile_id' => $profile->id,
            'post_comment_id' => $commentId,
        ]);

        if (empty($postCommentLike)|| !isset($postCommentLike[0])) {
            return $this->sendError('Post Comment Like not found', CODE_NOT_FOUND);
        }

        $postCommentLike[0]->delete();
        //$this->postCommentLikeRepository->update(['is_deleted' => STATUS_DELETED], $postCommentLike[0]->id);

        return $this->sendResponse($commentId, 'Post Comment Like deleted successfully');
    }
}
