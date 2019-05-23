<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Requests\API\CreatePostCommentReportAPIRequest;
use App\Models\PostCommentReport;
use App\Repositories\Api\PostCommentReportRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PostCommentReportController
 * @package App\Http\Controllers\API
 */
class PostCommentReportController extends AppBaseController
{
    /** @var  PostCommentReportRepository */
    private $postCommentReportRepository;

    public function __construct(PostCommentReportRepository $postCommentReportRepo)
    {
        $this->postCommentReportRepository = $postCommentReportRepo;
    }

    /**
     * Display a listing of the PostCommentReport.
     * GET|HEAD /postCommentReports
     *
     * @param  int $commentId
     * @param Request $request
     * @return Response
     */
    public function index($commentId, Request $request)
    {
        $this->postCommentReportRepository->pushCriteria(new RequestCriteria($request));
        $this->postCommentReportRepository->pushCriteria(new LimitOffsetCriteria($request));
        $commentLikes = $this->postCommentReportRepository->findByField('post_comment_id', $commentId);
        $result = $commentLikes->toArray();

        return $this->sendResponse($result, 'Post Comment Report retrieved successfully', count($result));
    }

    /**
     * Store a newly created PostCommentReport in storage.
     * POST /postCommentReports
     *
     * @param  int $commentId
     * @param CreatePostCommentReportAPIRequest $request
     *
     * @return Response
     */
    public function store($commentId, CreatePostCommentReportAPIRequest $request)
    {
        $profile = \Auth::user();
        $input = $request->all();
        $input['profile_id'] = $profile->id;
        $input['post_comment_id'] = $commentId;

        $validator = \Validator::make($input, [
            'post_comment_id' => 'required|integer|exists:e_post_comment,id|unique_with:e_post_comment_report,profile_id,' . $input['profile_id']
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->messages(), CODE_INTERNAL_SERVER_ERROR);
        }

        $postCommentReports = $this->postCommentReportRepository->create($input);

        return $this->sendResponse($postCommentReports->toArray(), 'Post Comment Report saved successfully');
    }

    /**
     * Remove the specified PostCommentReport from storage.
     * DELETE /postCommentReports/{id}
     *
     * @param  int $commentId
     *
     * @return Response
     */
    public function destroy($commentId)
    {
        $profile = \Auth::user();

        $postCommentReport = $this->postCommentReportRepository->findWhere([
            'profile_id' => $profile->id,
            'post_comment_id' => $commentId,
        ]);

        if (empty($postCommentReport)|| !isset($postCommentReport[0])) {
            return $this->sendError('Post Comment Report not found', CODE_NOT_FOUND);
        }

        $postCommentReport[0]->delete();
        //$this->postCommentLikeRepository->update(['is_deleted' => STATUS_DELETED], $postCommentLike[0]->id);

        return $this->sendResponse($commentId, 'Post Comment Report deleted successfully');
    }
}
