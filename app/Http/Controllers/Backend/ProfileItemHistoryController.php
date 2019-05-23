<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateProfileItemHistoryRequest;
use App\Http\Requests\Backend\UpdateProfileItemHistoryRequest;
use App\Models\ProfileItemHistory;
use App\Repositories\Backend\ProfileItemHistoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProfileItemHistoryController extends AppBaseController
{
    /** @var  ProfileItemHistoryRepository */
    private $profileItemHistoryRepository;

    public function __construct(ProfileItemHistoryRepository $profileItemHistoryRepo)
    {
        $this->profileItemHistoryRepository = $profileItemHistoryRepo;
    }

    /**
     * Display a listing of the ProfileItemHistory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $username = Input::get('username', '');
        $item_name = Input::get('item_name', '');
        $start_time = Input::get('start_time', '');
        $end_time = Input::get('end_time', '');

        $query = ProfileItemHistory::join('e_item', 'e_profile_item_history.item_id', '=', 'e_item.id')
                                    ->join('e_profile', 'e_profile_item_history.profile_id', '=', 'e_profile.id')
                                    ->select('e_profile_item_history.*');

        if (!empty($username)){
            $query->where('e_profile.name', 'like', '%'.$username.'%');
        }

        if (!empty($item_name)){
            $query->where('e_item.name', 'like', '%'.$item_name.'%');
        }

        if (!empty($start_time)) {
            $startTime = \DateTime::createFromFormat('Y-m-d', $start_time);
            $query->where('e_profile_item_history.created_at', '>=', $startTime->format('Y-m-d 00:00:00'));
        }

        if (!empty($end_time)) {
            $endTime = \DateTime::createFromFormat('Y-m-d', $end_time);
            $query->where('e_profile_item_history.created_at', '<=', $endTime->format('Y-m-d 23:59:59'));
        }
        $profileItemHistories = $query->paginate();

        return view('backend.profile_item_histories.index')
            ->with(['profileItemHistories' => $profileItemHistories, 'start_time' => $start_time, 'end_time' => $end_time]);
    }

    /**
     * Show the form for creating a new ProfileItemHistory.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.profile_item_histories.create');
    }

    /**
     * Store a newly created ProfileItemHistory in storage.
     *
     * @param CreateProfileItemHistoryRequest $request
     *
     * @return Response
     */
    public function store(CreateProfileItemHistoryRequest $request)
    {
        $input = $request->all();

        $profileItemHistory = $this->profileItemHistoryRepository->create($input);

        Flash::success('Profile Item History saved successfully.');

        return redirect(route('backend.profileItemHistories.index'));
    }

    /**
     * Display the specified ProfileItemHistory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $profileItemHistory = $this->profileItemHistoryRepository->findWithoutFail($id);

        if (empty($profileItemHistory)) {
            Flash::error('Profile Item History not found');

            return redirect(route('backend.profileItemHistories.index'));
        }

        return view('backend.profile_item_histories.show')->with('profileItemHistory', $profileItemHistory);
    }

    /**
     * Show the form for editing the specified ProfileItemHistory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $profileItemHistory = $this->profileItemHistoryRepository->findWithoutFail($id);

        if (empty($profileItemHistory)) {
            Flash::error('Profile Item History not found');

            return redirect(route('backend.profileItemHistories.index'));
        }

        return view('backend.profile_item_histories.edit')->with('profileItemHistory', $profileItemHistory);
    }

    /**
     * Update the specified ProfileItemHistory in storage.
     *
     * @param  int              $id
     * @param UpdateProfileItemHistoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfileItemHistoryRequest $request)
    {
        $profileItemHistory = $this->profileItemHistoryRepository->findWithoutFail($id);

        if (empty($profileItemHistory)) {
            Flash::error('Profile Item History not found');

            return redirect(route('backend.profileItemHistories.index'));
        }

        $profileItemHistory = $this->profileItemHistoryRepository->update($request->all(), $id);

        Flash::success('Profile Item History updated successfully.');

        return redirect(route('backend.profileItemHistories.index'));
    }

    /**
     * Remove the specified ProfileItemHistory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $profileItemHistory = $this->profileItemHistoryRepository->findWithoutFail($id);

        if (empty($profileItemHistory)) {
            Flash::error('Profile Item History not found');

            return redirect(route('backend.profileItemHistories.index'));
        }

        $this->profileItemHistoryRepository->delete($id);

        Flash::success('Profile Item History deleted successfully.');

        return redirect(route('backend.profileItemHistories.index'));
    }
}
