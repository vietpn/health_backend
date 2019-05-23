<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateProfileBlockRequest;
use App\Http\Requests\Backend\UpdateProfileBlockRequest;
use App\Repositories\Backend\ProfileBlockRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProfileBlockController extends AppBaseController
{
    /** @var  ProfileBlockRepository */
    private $profileBlockRepository;

    public function __construct(ProfileBlockRepository $profileBlockRepo)
    {
        $this->profileBlockRepository = $profileBlockRepo;
    }

    /**
     * Display a listing of the ProfileBlock.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->profileBlockRepository->pushCriteria(new RequestCriteria($request));
        $profileBlocks = $this->profileBlockRepository->all();

        foreach ($profileBlocks as $key => $profileBlock) {
            $profile = User::whereIn('id', [$profileBlock->profile_id, $profileBlock->profile_id_block])->get();
            $profileBlocks[$key]['profile_name'] = (isset($profile[0]->username)) ? $profile[0]->username : '';
            $profileBlocks[$key]['profile_report_name'] = (isset($profile[1]->username)) ? $profile[1]->username : '';
        }
        /*$profileBlocks = ProfileBlock::paginate(15);*/

        return view('backend.profile_blocks.index')
            ->with('profileBlocks', $profileBlocks);
    }

    /**
     * Display the specified ProfileBlock.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $profileBlock = $this->profileBlockRepository->findWithoutFail($id);

        if (empty($profileBlock)) {
            Flash::error('Profile Block not found');

            return redirect(route('backend.profileBlocks.index'));
        }

        return view('backend.profile_blocks.show')->with('profileBlock', $profileBlock);
    }

    /**
     * Remove the specified ProfileBlock from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $profileBlock = $this->profileBlockRepository->findWithoutFail($id);

        if (empty($profileBlock)) {
            Flash::error('Profile Block not found');

            return redirect(route('backend.profileBlocks.index'));
        }

        $this->profileBlockRepository->delete($id);

        Flash::success('Profile Block deleted successfully.');

        return redirect(route('backend.profileBlocks.index'));
    }
}
