<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Requests\API\CreateProfileCostumeAPIRequest;
use App\Http\Requests\API\UpdateProfileCostumeAPIRequest;
use App\Models\Item;
use App\Models\ProfileCostume;
use App\Models\ProfileItemHistory;
use App\Repositories\Api\ProfileCostumeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ProfileCostumeController
 * @package App\Http\Controllers\API
 */

class ProfileCostumeController extends AppBaseController
{
    /** @var  ProfileCostumeRepository */
    private $profileCostumeRepository;

    public function __construct(ProfileCostumeRepository $profileCostumeRepo)
    {
        $this->profileCostumeRepository = $profileCostumeRepo;
    }

    /**
     * Display a listing of the ProfileCostume.
     * GET|HEAD /profileCostumes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->profileCostumeRepository->pushCriteria(new RequestCriteria($request));
        $this->profileCostumeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $profileCostumes = $this->profileCostumeRepository->all();

        return $this->sendResponse($profileCostumes->toArray(), 'Profile Costumes retrieved successfully');
    }

    public function costume(Request $request){
        $profile = \Auth::user();
        $result = $profile->toArray();
        //Get items profile using.
        $result['costume_item'] = [];
        $costumes = ProfileCostume::select('item_ids')->where('profile_id', $profile->id)->first();
        $item_ids = explode(",", $costumes['item_ids']);
        if (count($item_ids) > 0){
            $items = Item::whereIn('id', $item_ids)->orderBy('id')->get();
            $result['costume_item'] = $items->toArray();
        }

        return $this->sendResponse($result, 'Profile Costumes retrieved successfully');
    }

    public function setCostume(Request $request){
        $profile = \Auth::user();
        $item_ids = $request['item_id'];
        $result = [];
        if (isset($item_ids)) {
            $item_ids = explode(',', $item_ids);
            if (count($item_ids) > 0) {
                foreach ($item_ids as $value) {
                    $itmHisArr = [];
                    $itemsHis = ProfileItemHistory::select('item_id')->where(['profile_id' => $profile->id])->get()->toArray();
                    foreach ($itemsHis as $val){
                        $itmHisArr[] = $val['item_id'];
                    }

                    if(!in_array($value,$itmHisArr)){
                        return [
                            'success' => false,
                            'data' => trans('You have not purchased this item (id=' . $value . ') yet'),
                            'code' => 500,
                        ];
                    }

                    $itemExist = array_count_values($item_ids);
                    $item = Item::select('id')->where('id', $value)->first();
                    if (!isset($item) ) {
                        return [
                            'success' => false,
                            'data' => trans('Item (id=' . $value . ') is not exit'),
                            'code' => 500,
                        ];
                    }
                }
            }

            $profileCostume = ProfileCostume::where('profile_id', $profile->id)->first();
            if (!isset($profileCostume)){
                $profileCostume = new ProfileCostume();
            }
            $profileCostume->profile_id = $profile->id;
            $profileCostume->item_ids = $request['item_id'];
            $profileCostume->updated_at = date('Y-m-d H:i:s');
            $profileCostume->save();
            $result = $profileCostume->toArray();
        }
        return [
            'success' => true,
            'data' => $result,
        ];
    }

    /**
     * Store a newly created ProfileCostume in storage.
     * POST /profileCostumes
     *
     * @param CreateProfileCostumeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProfileCostumeAPIRequest $request)
    {
        $input = $request->all();

        $profileCostumes = $this->profileCostumeRepository->create($input);

        return $this->sendResponse($profileCostumes->toArray(), 'Profile Costume saved successfully');
    }

    /**
     * Display the specified ProfileCostume.
     * GET|HEAD /profileCostumes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ProfileCostume $profileCostume */
        $profileCostume = $this->profileCostumeRepository->findWithoutFail($id);

        if (empty($profileCostume)) {
            return $this->sendError('Profile Costume not found');
        }

        return $this->sendResponse($profileCostume->toArray(), 'Profile Costume retrieved successfully');
    }

    /**
     * Update the specified ProfileCostume in storage.
     * PUT/PATCH /profileCostumes/{id}
     *
     * @param  int $id
     * @param UpdateProfileCostumeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfileCostumeAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProfileCostume $profileCostume */
        $profileCostume = $this->profileCostumeRepository->findWithoutFail($id);

        if (empty($profileCostume)) {
            return $this->sendError('Profile Costume not found');
        }

        $profileCostume = $this->profileCostumeRepository->update($input, $id);

        return $this->sendResponse($profileCostume->toArray(), 'ProfileCostume updated successfully');
    }

    /**
     * Remove the specified ProfileCostume from storage.
     * DELETE /profileCostumes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ProfileCostume $profileCostume */
        $profileCostume = $this->profileCostumeRepository->findWithoutFail($id);

        if (empty($profileCostume)) {
            return $this->sendError('Profile Costume not found');
        }

        $profileCostume->delete();

        return $this->sendResponse($id, 'Profile Costume deleted successfully');
    }
}
