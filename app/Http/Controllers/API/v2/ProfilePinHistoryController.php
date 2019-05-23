<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Requests\API\CreateProfilePinHistoryAPIRequest;
use App\Http\Requests\API\UpdateProfilePinHistoryAPIRequest;
use App\Models\Pin;
use App\Models\ProfilePinHistory;
use App\Repositories\Api\ProfilePinHistoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use phpseclib\Crypt\DES;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ProfilePinHistoryController
 * @package App\Http\Controllers\API
 */

class ProfilePinHistoryController extends AppBaseController
{
    /** @var  ProfilePinHistoryRepository */
    private $profilePinHistoryRepository;

    public function __construct(ProfilePinHistoryRepository $profilePinHistoryRepo)
    {
        $this->profilePinHistoryRepository = $profilePinHistoryRepo;
    }

    /**
     * Display a listing of the ProfilePinHistory.
     * GET|HEAD /profilePinHistories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->profilePinHistoryRepository->pushCriteria(new RequestCriteria($request));
        $this->profilePinHistoryRepository->pushCriteria(new LimitOffsetCriteria($request));
        $profilePinHistories = $this->profilePinHistoryRepository->all();

        return $this->sendResponse($profilePinHistories->toArray(), 'Profile Pin Histories retrieved successfully');
    }

    /**
     * Store a newly created ProfilePinHistory in storage.
     * POST /profilePinHistories
     *
     * @param CreateProfilePinHistoryAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProfilePinHistoryAPIRequest $request)
    {
        $input = $request->all();

        $profilePinHistories = $this->profilePinHistoryRepository->create($input);

        return $this->sendResponse($profilePinHistories->toArray(), 'Profile Pin History saved successfully');
    }

    /**
     * Display the specified ProfilePinHistory.
     * GET|HEAD /profilePinHistories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ProfilePinHistory $profilePinHistory */
        $profilePinHistory = $this->profilePinHistoryRepository->findWithoutFail($id);

        if (empty($profilePinHistory)) {
            return $this->sendError('Profile Pin History not found');
        }

        return $this->sendResponse($profilePinHistory->toArray(), 'Profile Pin History retrieved successfully');
    }

    /**
     * Update the specified ProfilePinHistory in storage.
     * PUT/PATCH /profilePinHistories/{id}
     *
     * @param  int $id
     * @param UpdateProfilePinHistoryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfilePinHistoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProfilePinHistory $profilePinHistory */
        $profilePinHistory = $this->profilePinHistoryRepository->findWithoutFail($id);

        if (empty($profilePinHistory)) {
            return $this->sendError('Profile Pin History not found');
        }

        $profilePinHistory = $this->profilePinHistoryRepository->update($input, $id);

        return $this->sendResponse($profilePinHistory->toArray(), 'ProfilePinHistory updated successfully');
    }

    /**
     * Remove the specified ProfilePinHistory from storage.
     * DELETE /profilePinHistories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ProfilePinHistory $profilePinHistory */
        $profilePinHistory = $this->profilePinHistoryRepository->findWithoutFail($id);

        if (empty($profilePinHistory)) {
            return $this->sendError('Profile Pin History not found');
        }

        $profilePinHistory->delete();

        return $this->sendResponse($id, 'Profile Pin History deleted successfully');
    }

    public function pinHistoryProfile(){
        $profile = \Auth::user();
        $pins = [];
        $pinHis = ProfilePinHistory::select('pin_id')->where('profile_id',$profile->id)->orderBy('id', 'DESC')->distinct()->pluck('pin_id')->toArray();
        if (count($pinHis) > 0){
            foreach ($pinHis as $val){
                $pin = Pin::where('id', $val)->first();
                if (isset($pin)){
                    $pins[] = $pin;
                }
            }
        }

        return $this->sendResponse($pins, 'List pins of user', count($pins));
    }
}
