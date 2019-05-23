<?php

namespace App\Http\Controllers\Backend;

use App\Define\Systems;
use App\Http\Requests\Backend\CreateProfileRequest;
use App\Http\Requests\Backend\UpdateProfileRequest;
use App\Models\Backend\ProfilePlusHistory;
use App\Models\BaseModel;
use App\Models\ProfileHistory;
use App\Repositories\Backend\ProfileRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfileController extends AppBaseController
{
    /** @var  ProfileRepository */
    private $profileRepository;
    public $systems;
    public function __construct(ProfileRepository $profileRepo,Systems $systems)
    {
        $this->profileRepository = $profileRepo;
        $this->systems = $systems;
    }

    /**
     * Display a listing of the Profile.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $profiles = $this->profileRepository->querySearch($request);
        $profiles = $profiles->paginate(Systems::PAGES_NUM);
        $age = $this->getAge();
//        if (\Request::ajax()) {
//            return Response::json(view('backend.profiles.table_search_member', array('profiles' => $profiles))->render());
//        }
        return view('backend.profiles.index', compact('profiles', 'age'));
    }

    /**
     * Show the form for creating a new Profile.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.profiles.create');
    }

    /**
     * Store a newly created Profile in storage.
     *
     * @param CreateProfileRequest $request
     *
     * @return Response
     */
    public function store(CreateProfileRequest $request)
    {
        $input = $request->all();

        $profile = $this->profileRepository->create($input);

        Flash::success('Profile saved successfully.');

        return redirect(route('backend.profiles.index'));
    }

    /**
     * Display the specified Profile.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $profile = $this->profileRepository->find($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('backend.profiles.index'));
        }
        if ($profile->is_business == PROFILE_DEFAULT) {
            $profileUser = $profile->getProfileUsers()->first();
            if (!$profileUser) {
                Flash::error('Profile not found');
                return redirect(route('backend.profiles.index'));
            }
            return view('backend.profiles.show.profile_normal', compact('profile', 'profileUser'));
        } else {
            $profileUser = $profile->getProfileBussiness()->first();
            if (!$profileUser) {
                Flash::error('Profile not found');
                return redirect(route('backend.profiles.index'));
            }
            return view('backend.profiles.show.profile_normal', compact('profile', 'profileUser'));
        }

    }

    /**
     * Show the form for editing the specified Profile.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $profile = $this->profileRepository->find($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('backend.profiles.index'));
        }

        return view('backend.profiles.edit')->with('profile', $profile);
    }

    /**
     * Update the specified Profile in storage.
     *
     * @param  int $id
     * @param UpdateProfileRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfileRequest $request)
    {
        $profile = $this->profileRepository->find($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('backend.profiles.index'));
        }

        $profile = $this->profileRepository->update($request->all(), $id);

        Flash::success('Profile updated successfully.');

        return redirect(route('backend.profiles.index'));
    }

    public function showBanNick($id)
    {
        $profile = $this->findModel(intval($id));
        return view('backend.profiles.ban_nick.index', compact('profile'));
    }

    public function banNick(Request $request)
    {
        if (\Request::ajax()) {
            $return = ['error' => true, 'message' => ''];
            try {
                $id = $request->input('id', "");
                $model = $this->findModel(intval($id));
                if ($model->update([
                    'status' => BaseModel::STATUS_DISABLE
                ])
                ) {
                    $return['error'] = false;
                    $return['message'] = 'Update Suceess';
                }

            } catch (\Exception $e) {
                $return['message'] = $e->getMessage();
            }
            return Response::json($return);
        }
    }
    public function activeNick(Request $request){
        if (\Request::ajax()) {
            $return = ['error' => true, 'message' => ''];
            try {
                $id = $request->input('id', "");
                $model = $this->findModel(intval($id));
                if ($model->update([
                    'status' => BaseModel::STATUS_ENABLE
                ])
                ) {
                    $return['error'] = false;
                    $return['message'] = 'Update Suceess';
                }

            } catch (\Exception $e) {
                $return['message'] = $e->getMessage();
            }
            return Response::json($return);
        }
    }
    public function showPoint($id, Request $request)
    {
        $model = $this->findModel(intval($id));
        $typePoint = $request->get('type_point', 0);
//        dd($typePoint);
        $time = $request->get('time', "");
        $startTime = "";
        $endTime = "";
        if (!empty($time)) {
            $dataTime = explode('-', $time);
            if ($dataTime) {
                $startTime = date('Y-m-d 00:00:00', strtotime($dataTime[0]));
                $endTime = date('Y-m-d 23:59:59', strtotime($dataTime[1]));
            }

        } else {
            $startTime = date('Y-m-01 00:00:00');
            $endTime = date('Y-m-d 23:59:59');
        }
        if ($typePoint == 0) {
            $datapoint = ProfileHistory::where('profile_id', $id)
                ->where('created_at', '>=', $startTime)
                ->where('created_at', '<=', $endTime)
                ->orderBy('id', SORT_DESC)->paginate(15);
        } else {
            $datapoint = ProfilePlusHistory::where('profile_id', $id)
                ->where('created_at', '>=', $startTime)
                ->where('created_at', '<=', $endTime)
                ->orderBy('id', SORT_DESC)->paginate(15);
        }
        return view('backend.profiles.show_point.index', compact('model', 'datapoint'));
    }

    protected function findModel($id)
    {
        if ($model = User::find(intval($id))) {
            return $model;
        } else {
            throw new NotFoundHttpException("Profile not Exits");
        }
    }

    /**
     * Remove the specified Profile from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {

        $profile = $this->profileRepository->find($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('backend.profiles.index'));
        }

        $this->profileRepository->delete($id);

        Flash::success('Profile deleted successfully.');

        return redirect(route('backend.profiles.index'));
    }
}
