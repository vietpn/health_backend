<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateProfileFavoriteRequest;
use App\Http\Requests\Backend\UpdateProfileFavoriteRequest;
use App\Repositories\Backend\ProfileFavoriteRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProfileFavoriteController extends AppBaseController
{
    /** @var  ProfileFavoriteRepository */
    private $profileFavoriteRepository;

    public function __construct(ProfileFavoriteRepository $profileFavoriteRepo)
    {
        $this->profileFavoriteRepository = $profileFavoriteRepo;
    }

    /**
     * Display a listing of the ProfileFavorite.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->profileFavoriteRepository->pushCriteria(new RequestCriteria($request));
        $profileFavorites = $this->profileFavoriteRepository->all();

        foreach ($profileFavorites as $key => $profileFavorite){
            $profile = User::whereIn('id', [$profileFavorite->profile_id, $profileFavorite->profile_id_favorite])->get();
            $profileFavorites[$key]['profile_name'] = (isset($profile[0]->username)) ? $profile[0]->username : '';
            $profileFavorites[$key]['profile_report_name'] = (isset($profile[1]->username)) ? $profile[1]->username : '';
        }
        /*$profileFavorites = ProfileFavorite::paginate(15);*/

        return view('backend.profile_favorites.index')
            ->with('profileFavorites', $profileFavorites);
    }

    /**
     * Display the specified ProfileFavorite.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $profileFavorite = $this->profileFavoriteRepository->findWithoutFail($id);

        if (empty($profileFavorite)) {
            Flash::error('Profile Favorite not found');

            return redirect(route('backend.profileFavorites.index'));
        }

        return view('backend.profile_favorites.show')->with('profileFavorite', $profileFavorite);
    }

    /**
     * Remove the specified ProfileFavorite from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $profileFavorite = $this->profileFavoriteRepository->findWithoutFail($id);

        if (empty($profileFavorite)) {
            Flash::error('Profile Favorite not found');

            return redirect(route('backend.profileFavorites.index'));
        }

        $this->profileFavoriteRepository->delete($id);

        Flash::success('Profile Favorite deleted successfully.');

        return redirect(route('backend.profileFavorites.index'));
    }
}
