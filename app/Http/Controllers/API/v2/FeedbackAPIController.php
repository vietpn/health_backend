<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Requests\API\CreateFeedbackAPIRequest;
use App\Http\Requests\API\UpdateFeedbackAPIRequest;
use App\Models\Feedback;
use App\Repositories\Api\FeedbackRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class FeedbackController
 * @package App\Http\Controllers\API
 */

class FeedbackAPIController extends AppBaseController
{
    /** @var  FeedbackRepository */
    private $feedbackRepository;

    public function __construct(FeedbackRepository $feedbackRepo)
    {
        $this->feedbackRepository = $feedbackRepo;
    }

    /**
     * Display a listing of the Feedback.
     * GET|HEAD /feedback
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $profile = \Auth::user();
        $this->feedbackRepository->pushCriteria(new RequestCriteria($request));
        $this->feedbackRepository->pushCriteria(new LimitOffsetCriteria($request));
        $feedback = $this->feedbackRepository->findByField('profile_id', $profile->id);

        return $this->sendResponse($feedback->toArray(), 'Feedback retrieved successfully');
    }

    /**
     * Store a newly created Feedback in storage.
     * POST /feedback
     *
     * @param CreateFeedbackAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFeedbackAPIRequest $request)
    {
        $input = $request->all();

        $feedback = $this->feedbackRepository->create($input);

        return $this->sendResponse($feedback->toArray(), 'Feedback saved successfully');
    }

    /**
     * Display the specified Feedback.
     * GET|HEAD /feedback/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Feedback $feedback */
        $feedback = $this->feedbackRepository->findWithoutFail($id);

        if (empty($feedback)) {
            return $this->sendError('Feedback not found');
        }

        return $this->sendResponse($feedback->toArray(), 'Feedback retrieved successfully');
    }

    /**
     * Update the specified Feedback in storage.
     * PUT/PATCH /feedback/{id}
     *
     * @param  int $id
     * @param UpdateFeedbackAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFeedbackAPIRequest $request)
    {
        $input = $request->all();

        /** @var Feedback $feedback */
        $feedback = $this->feedbackRepository->findWithoutFail($id);

        if (empty($feedback)) {
            return $this->sendError('Feedback not found');
        }

        $feedback = $this->feedbackRepository->update($input, $id);

        return $this->sendResponse($feedback->toArray(), 'Feedback updated successfully');
    }

    /**
     * Remove the specified Feedback from storage.
     * DELETE /feedback/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Feedback $feedback */
        $feedback = $this->feedbackRepository->findWithoutFail($id);

        if (empty($feedback)) {
            return $this->sendError('Feedback not found');
        }

        $feedback->delete();

        return $this->sendResponse($id, 'Feedback deleted successfully');
    }
}
