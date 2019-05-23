<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Requests\API\CreatePostCommentAPIRequest;
use App\Http\Requests\API\UpdatePostCommentAPIRequest;
use App\Models\BaseModel;
use App\Models\PostComment;
use App\Repositories\Api\PostCommentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Validator;

/**
 * Class PostCommentController
 * @package App\Http\Controllers\API\V2
 */
class PostCommentController extends AppBaseController
{
    /** @var  PostCommentRepository */
    private $postCommentRepository;

    public function __construct(PostCommentRepository $postCommentRepo)
    {
        $this->postCommentRepository = $postCommentRepo;
    }

    /**
     * Display a listing of the PostComment.
     * GET|HEAD /postComments
     *
     * @param  int $postId
     * @param Request $request
     * @return Response
     */
    public function index($postId, Request $request)
    {
        $this->postCommentRepository->pushCriteria(new RequestCriteria($request));
        $this->postCommentRepository->pushCriteria(new LimitOffsetCriteria($request));
        $postComments = $this->postCommentRepository->findByField('post_id', $postId);
        $result = $postComments->toArray();

        return $this->sendResponse($result, 'Post Comments retrieved successfully', count($result));
    }

    /**
     * Store a newly created PostComment in storage.
     * POST /postComments
     *
     * @param  int $postId
     * @param CreatePostCommentAPIRequest $request
     *
     * @return Response
     */
    public function store($postId, CreatePostCommentAPIRequest $request)
    {
        $profile = \Auth::user();
        $input = $request->all();
        $input['profile_id'] = $profile->id;
        $input['post_id'] = $postId;

        $validator = Validator::make($input, [
            'post_id' => 'required|integer|exists:e_post,id'
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->messages(), CODE_NOT_FOUND);
        }

        $postComments = $this->postCommentRepository->create($input);

        return $this->sendResponse($postComments->toArray(), 'Post Comment saved successfully');
    }

    /**
     * Display the specified PostComment.
     * GET|HEAD /postComments/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PostComment $postComment */
        $postComment = $this->postCommentRepository->findWithoutFail($id);

        if (empty($postComment)) {
            return $this->sendError('Post Comment not found', CODE_NOT_FOUND);
        }
        $postComment['likes'] = $postComment->postCommentLikes()->get();

        return $this->sendResponse($postComment->toArray(), 'Post Comment retrieved successfully');
    }

    /**
     * Update the specified PostComment in storage.
     * PUT/PATCH /postComments/{id}
     *
     * @param  int $id
     * @param UpdatePostCommentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostCommentAPIRequest $request)
    {
        $profile = \Auth::user();
        $input = $request->all();

        /** @var PostComment $postComment */
        $postComment = $this->postCommentRepository->findWhere([
            'profile_id' => $profile->id,
            'id' => $id
        ]);

        if (empty($postComment) || !isset($postComment[0])) {
            return $this->sendError('Post Comment not found', CODE_NOT_FOUND);
        }

        $postComment = $this->postCommentRepository->update($input, $id);

        return $this->sendResponse($postComment->toArray(), 'PostComment updated successfully');
    }

    /**
     * Remove the specified PostComment from storage.
     * DELETE /postComments/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $profile = \Auth::user();

        /** @var PostComment $postComment */
        $postComment = $this->postCommentRepository->findWhere([
            'profile_id' => $profile->id,
            'id' => $id,
        ]);

        if (empty($postComment) || !isset($postComment[0])) {
            return $this->sendError('Post Comment not found', CODE_NOT_FOUND);
        }

//        $postComment[0]->delete();
        $this->postCommentRepository->update(['is_deleted' => STATUS_DELETED], $id);

        return $this->sendResponse($id, 'Post Comment deleted successfully');
    }
}
