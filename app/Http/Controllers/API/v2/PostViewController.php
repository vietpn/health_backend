<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Requests\API\CreatePostViewAPIRequest;
use App\Models\PostView;
use App\Repositories\Api\PostViewRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Validator;

/**
 * Class PostViewController
 * @package App\Http\Controllers\API\V2
 */

class PostViewController extends AppBaseController
{
    /** @var  PostViewRepository */
    private $postViewRepository;

    public function __construct(PostViewRepository $postViewRepo)
    {
        $this->postViewRepository = $postViewRepo;
    }

    /**
     * Display a listing of the PostView.
     * GET|HEAD /postViews
     *
     * @param  int $postId
     * @param Request $request
     * @return Response
     */
    public function index($postId, Request $request)
    {
        $this->postViewRepository->pushCriteria(new RequestCriteria($request));
        $this->postViewRepository->pushCriteria(new LimitOffsetCriteria($request));
        $postViews = $this->postViewRepository->findByField('post_id', $postId);
        $result = $postViews->toArray();

        return $this->sendResponse($result, 'Post Views retrieved successfully', count($result));
    }

    /**
     * Store a newly created PostView in storage.
     * POST /postViews
     *
     * @param  int $postId
     * @param CreatePostViewAPIRequest $request
     *
     * @return Response
     */
    public function store($postId, CreatePostViewAPIRequest $request)
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

        $postViews = $this->postViewRepository->create($input);

        return $this->sendResponse($postViews->toArray(), 'Post View saved successfully');
    }
}
