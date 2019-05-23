<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Requests\API\CreatePostReportAPIRequest;
use App\Models\V2\PostReport;
use App\Repositories\Api\PostReportRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PostReportController
 * @package App\Http\Controllers\API\V2
 */
class PostReportController extends AppBaseController
{
    /** @var  PostReportRepository */
    private $postReportRepository;

    public function __construct(PostReportRepository $postReportRepo)
    {
        $this->postReportRepository = $postReportRepo;
    }

    /**
     * Display a listing of the PostReport.
     * GET|HEAD /postReports
     *
     * @param Request $request
     * @return Response
     */
    public function index($postId, Request $request)
    {
        $this->postReportRepository->pushCriteria(new RequestCriteria($request));
        $this->postReportRepository->pushCriteria(new LimitOffsetCriteria($request));
        $postReports = $this->postReportRepository->findByField('post_id', $postId);
        $result = $postReports->toArray();

        return $this->sendResponse($result, 'Post Reports retrieved successfully', count($result));
    }

    /**
     * Store a newly created PostReport in storage.
     * POST /postReports
     *
     * @param  int $postId
     * @param CreatePostReportAPIRequest $request
     *
     * @return Response
     */
    public function store($postId, CreatePostReportAPIRequest $request)
    {
        $profile = \Auth::user();
        $input = $request->all();
        $input['profile_id'] = $profile->id;
        $input['post_id'] = $postId;

        $validator = \Validator::make($input, [
            'post_id' => 'required|integer|exists:e_post,id|unique_with:e_post_report,profile_id,' . $input['profile_id']
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->messages(), CODE_NOT_FOUND);
        }

        $postReports = $this->postReportRepository->create($input);


        return $this->sendResponse($postReports->toArray(), 'Post Report saved successfully');
    }

    /**
     * Remove the specified PostReport from storage.
     * DELETE /postReports/{id}
     *
     * @param  int $postId
     *
     * @return Response
     */
    public function destroy($postId)
    {
        $profile = \Auth::user();

        /** @var PostReport $postReport */
        $postReport = $this->postReportRepository->findWhere([
            'profile_id' => $profile->id,
            'post_id' => $postId,
        ]);

        if (empty($postReport) || !isset($postReport[0])) {
            return $this->sendError('Post Report not found', CODE_NOT_FOUND);
        }

        $postReport[0]->delete();

        return $this->sendResponse($postId, 'Post Report deleted successfully');
    }
}
