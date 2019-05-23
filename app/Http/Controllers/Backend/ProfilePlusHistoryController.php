<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateProfilePlusHistoryRequest;
use App\Http\Requests\Backend\UpdateProfilePlusHistoryRequest;
use App\Repositories\Backend\ProfilePlusHistoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProfilePlusHistoryController extends AppBaseController
{
    /** @var  ProfilePlusHistoryRepository */
    private $profilePlusHistoryRepository;

    public function __construct(ProfilePlusHistoryRepository $profilePlusHistoryRepo)
    {
        $this->profilePlusHistoryRepository = $profilePlusHistoryRepo;
    }

    /**
     * Display a listing of the ProfilePlusHistory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->profilePlusHistoryRepository->pushCriteria(new RequestCriteria($request));
        $profilePlusHistories = $this->profilePlusHistoryRepository->all();

        /*$profilePlusHistories = ProfilePlusHistory::paginate(15);*/

        return view('backend.profile_plus_histories.index')
            ->with('profilePlusHistories', $profilePlusHistories);
    }

    /**
     * Show the form for creating a new ProfilePlusHistory.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.profile_plus_histories.create');
    }

    /**
     * Store a newly created ProfilePlusHistory in storage.
     *
     * @param CreateProfilePlusHistoryRequest $request
     *
     * @return Response
     */
    public function store(CreateProfilePlusHistoryRequest $request)
    {
        $input = $request->all();

        $profilePlusHistory = $this->profilePlusHistoryRepository->create($input);

        Flash::success('Profile Plus History saved successfully.');

        return redirect(route('backend.profilePlusHistories.index'));
    }

    /**
     * Display the specified ProfilePlusHistory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $profilePlusHistory = $this->profilePlusHistoryRepository->findWithoutFail($id);

        if (empty($profilePlusHistory)) {
            Flash::error('Profile Plus History not found');

            return redirect(route('backend.profilePlusHistories.index'));
        }

        return view('backend.profile_plus_histories.show')->with('profilePlusHistory', $profilePlusHistory);
    }

    /**
     * Show the form for editing the specified ProfilePlusHistory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $profilePlusHistory = $this->profilePlusHistoryRepository->findWithoutFail($id);

        if (empty($profilePlusHistory)) {
            Flash::error('Profile Plus History not found');

            return redirect(route('backend.profilePlusHistories.index'));
        }

        return view('backend.profile_plus_histories.edit')->with('profilePlusHistory', $profilePlusHistory);
    }

    /**
     * Update the specified ProfilePlusHistory in storage.
     *
     * @param  int              $id
     * @param UpdateProfilePlusHistoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfilePlusHistoryRequest $request)
    {
        $profilePlusHistory = $this->profilePlusHistoryRepository->findWithoutFail($id);

        if (empty($profilePlusHistory)) {
            Flash::error('Profile Plus History not found');

            return redirect(route('backend.profilePlusHistories.index'));
        }

        $profilePlusHistory = $this->profilePlusHistoryRepository->update($request->all(), $id);

        Flash::success('Profile Plus History updated successfully.');

        return redirect(route('backend.profilePlusHistories.index'));
    }

    /**
     * Remove the specified ProfilePlusHistory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $profilePlusHistory = $this->profilePlusHistoryRepository->findWithoutFail($id);

        if (empty($profilePlusHistory)) {
            Flash::error('Profile Plus History not found');

            return redirect(route('backend.profilePlusHistories.index'));
        }

        $this->profilePlusHistoryRepository->delete($id);

        Flash::success('Profile Plus History deleted successfully.');

        return redirect(route('backend.profilePlusHistories.index'));
    }
}
