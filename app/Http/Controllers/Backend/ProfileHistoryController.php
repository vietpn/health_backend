<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateProfileHistoryRequest;
use App\Http\Requests\Backend\UpdateProfileHistoryRequest;
use App\Repositories\Backend\ProfileHistoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProfileHistoryController extends AppBaseController
{
    /** @var  ProfileHistoryRepository */
    private $profileHistoryRepository;

    public function __construct(ProfileHistoryRepository $profileHistoryRepo)
    {
        $this->profileHistoryRepository = $profileHistoryRepo;
    }

    /**
     * Display a listing of the ProfileHistory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->profileHistoryRepository->pushCriteria(new RequestCriteria($request));
        $profileHistories = $this->profileHistoryRepository->all();

        /*$profileHistories = ProfileHistory::paginate(15);*/

        return view('backend.profile_histories.index')
            ->with('profileHistories', $profileHistories);
    }

    /**
     * Show the form for creating a new ProfileHistory.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.profile_histories.create');
    }

    /**
     * Store a newly created ProfileHistory in storage.
     *
     * @param CreateProfileHistoryRequest $request
     *
     * @return Response
     */
    public function store(CreateProfileHistoryRequest $request)
    {
        $input = $request->all();

        $profileHistory = $this->profileHistoryRepository->create($input);

        Flash::success('Profile History saved successfully.');

        return redirect(route('backend.profileHistories.index'));
    }

    /**
     * Display the specified ProfileHistory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $profileHistory = $this->profileHistoryRepository->findWithoutFail($id);

        if (empty($profileHistory)) {
            Flash::error('Profile History not found');

            return redirect(route('backend.profileHistories.index'));
        }

        return view('backend.profile_histories.show')->with('profileHistory', $profileHistory);
    }

    /**
     * Show the form for editing the specified ProfileHistory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $profileHistory = $this->profileHistoryRepository->findWithoutFail($id);

        if (empty($profileHistory)) {
            Flash::error('Profile History not found');

            return redirect(route('backend.profileHistories.index'));
        }

        return view('backend.profile_histories.edit')->with('profileHistory', $profileHistory);
    }

    /**
     * Update the specified ProfileHistory in storage.
     *
     * @param  int              $id
     * @param UpdateProfileHistoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfileHistoryRequest $request)
    {
        $profileHistory = $this->profileHistoryRepository->findWithoutFail($id);

        if (empty($profileHistory)) {
            Flash::error('Profile History not found');

            return redirect(route('backend.profileHistories.index'));
        }

        $profileHistory = $this->profileHistoryRepository->update($request->all(), $id);

        Flash::success('Profile History updated successfully.');

        return redirect(route('backend.profileHistories.index'));
    }

    /**
     * Remove the specified ProfileHistory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $profileHistory = $this->profileHistoryRepository->findWithoutFail($id);

        if (empty($profileHistory)) {
            Flash::error('Profile History not found');

            return redirect(route('backend.profileHistories.index'));
        }

        $this->profileHistoryRepository->delete($id);

        Flash::success('Profile History deleted successfully.');

        return redirect(route('backend.profileHistories.index'));
    }
}
