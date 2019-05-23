<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\ProfileRequest;
use App\Models\BaseModel;
use App\Models\BloodType;
use App\Models\ZodiacSigns;
use App\Repositories\Api\ProfileRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Monolog\Formatter\ElasticaFormatter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Validator;
use Elasticsearch;

class UserController extends AppBaseController
{
    protected $profileRepository;

    public function __construct(ProfileRepository $profileRepositoryRepository)
    {
        $this->profileRepository = $profileRepositoryRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function about()
    {
        $user = $this->profileRepository->getInfor();

        $res = [
            'status' => 200,
            'success' => true,
            'code' => 1,
            'message' => MSG_SUCCESS,
            'data' => $user,
        ];
        return $this->sendResponseUser($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchNearBy(Request $request)
    {
        $rules = User::$ruleSearchNearby;
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->sendError($validator->messages(), CODE_NOT_FOUND);
        }
        $respone = $this->profileRepository->searchNearby($request);
        if ($respone === false || !isset($respone['data'])) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }

        return $this->sendResponse($respone['data'], MSG_SUCCESS);
    }

    /**
     * Upload Avatar of Profile
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadAvatar(ProfileRequest $request)
    {
        $respone = $this->profileRepository->uploadAvatar($request);
        if ($respone === false) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS);
    }

    /**
     * Update infor of Profile
     * @param ProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(ProfileRequest $request)
    {

        $respone = $this->profileRepository->updateProfile($request);
        if (!isset($respone)) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        if ($respone['success'] === false) {
            return $this->sendError($respone['data'], CODE_BAD_REQUEST);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS);
    }

    /**
     * @param ProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchProfile(ProfileRequest $request)
    {
        \Log::info(json_encode($request->all()), ['LOG_SEARCH_PROFILE_' => 1]);
        $respone = $this->profileRepository->searchProfile($request);
        if ($respone === false) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        if ($respone['success'] === false) {
            return $this->sendError($respone['code'], $respone['data']);
        }
        \Log::info(json_encode($respone['data']), ['LOG_RESPONE_DATA' => 1]);
        return $this->sendResponse($respone['data'], MSG_SUCCESS);
    }

    /**
     * tìm kiếm lịch sử mua point của từng user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchHistory(Request $request)
    {
        $respone = $this->profileRepository->searchHistoryConsumePoint($request);
        if ($respone === false) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        if ($respone['success'] === false) {
            return $this->sendError($respone['code'], $respone['data']);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS);
    }

    /**
     * @param ProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function blockProfile(ProfileRequest $request)
    {
        $profile = \Auth::user();
        $input = $request->all();
        $input['profile_id'] = $profile->id;

        $validator = Validator::make($input, [
            'profile_id_block' => 'required|integer|exists:e_profile,id|unique_with:e_profile_block,profile_id,' . $input['profile_id']
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->messages(), CODE_NOT_FOUND);
        }

        $respone = $this->profileRepository->blockProfile($request);

        if (!isset($respone)) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS);
    }

    /**
     * @param ProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unBlockProfile(ProfileRequest $request)
    {
        $respone = $this->profileRepository->unBlockProfile($request);
        if (!isset($respone)) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS);
    }

    /**
     * @param ProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function favoriteProfile(ProfileRequest $request)
    {
        $respone = $this->profileRepository->favoriteProfile($request);
        if (!isset($respone)) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS);
    }

    /**
     * @param ProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unFavoriteProfile(profileRequest $request)
    {
        $respone = $this->profileRepository->unFavoriteProfile($request);
        if (!isset($respone)) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS);
    }

    /**
     * @param ProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function favoritePost(ProfileRequest $request)
    {
        $respone = $this->profileRepository->favoritePost($request);
        if (!isset($respone)) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS);
    }

    /**
     * @param ProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unFavoritePost(profileRequest $request)
    {
        $respone = $this->profileRepository->unFavoritePost($request);
        if (!isset($respone)) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS);
    }

    /**
     * @param ProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportProfile(ProfileRequest $request)
    {
        $respone = $this->profileRepository->reportProfile($request);
        if (!isset($respone)) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS);
    }

    public function updateOnline(ProfileRequest $request)
    {
        $respone = $this->profileRepository->updateOnline($request);
        if ($respone === false) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        if ($respone['success'] === false) {
            return $this->sendError($respone['code'], $respone['data']);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchInforProfile($id)
    {
        $user = $this->findModel(intval($id));
        $userInfo = $this->profileRepository->showInforUser($user);
        if (\Cache::has('bLoodType')) {
            $bLoodType = \Cache::get('bLoodType');
        } else {
            $bLoodType = BloodType::all()->toArray();
            \Cache::add('bLoodType', $bLoodType, 3600 * 24);
        }
        if (\Cache::has('zodiacSigns')) {
            $zodiacSigns = \Cache::get('zodiacSigns');
        } else {
            $zodiacSigns = ZodiacSigns::all()->toArray();
            \Cache::add('zodiacSigns', $zodiacSigns, 3600 * 24);
        }
        $res = [
            'status' => 200,
            'success' => true,
            'code' => 1,
            'message' => MSG_SUCCESS,
            'data' => $userInfo,
            'blood_type' => $bLoodType,
            'zodiac_signs' => $zodiacSigns
        ];
        return $this->sendResponseUser($res);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     * @throws \Exception
     */
    private function findModel($id)
    {
        if (($model = User::find($id)) !== null) {
            return $model;
        } else {
            throw new \Exception('The requested user does not exist.');
        }
    }

    public function updateLocation(ProfileRequest $request)
    {

        $respone = $this->profileRepository->updateLocation($request);
        if ($respone === false) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        if ($respone['success'] === false) {
            return $this->sendError($respone['code'], $respone['data']);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS);
    }

    /**
     *
     * @param ProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function buyItem(ProfileRequest $request)
    {

        $respone = $this->profileRepository->buyItem($request);
        if ($respone === false) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        if ($respone['success'] === false) {
            return $this->sendError($respone['data'], $respone['code']);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS);
    }

    public function itemListByUser(ProfileRequest $request)
    {

        $respone = $this->profileRepository->itemListByUser($request);
        if ($respone === false) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        if ($respone['success'] === false) {
            return $this->sendError($respone['data'], $respone['code']);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS, $respone['total']);
    }

    public function searchFavoriteProfile(ProfileRequest $request)
    {

        $respone = $this->profileRepository->searchFavoriteProfile($request);
        if ($respone === false) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        if ($respone['success'] === false) {
            return $this->sendError($respone['data'], $respone['code']);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS, $respone['total']);
    }

    public function listFavoritePost(ProfileRequest $request)
    {
        $respone = $this->profileRepository->listFavoritePost($request);
        if ($respone === false) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        if ($respone['success'] === false) {
            return $this->sendError($respone['data'], $respone['code']);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS, $respone['total']);
    }

    public function updateProfileBusiness(Request $request)
    {
        $respone = $this->profileRepository->updateProfileBusiness($request);
        if (!isset($respone)) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS);
    }

    public function donatePoint(ProfileRequest $request)
    {
        $response = $this->profileRepository->donatePoint($request);

        if ($response === false) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        if ($response['success'] === false) {
            return $this->sendError($response['data'], $response['code']);
        }
        return $this->sendResponse($response['data'], MSG_SUCCESS);
    }

    /*
     * Get categories use da mua item
     * */
    public function categoryListByUser(ProfileRequest $request)
    {

        $respone = $this->profileRepository->categoryListByUser($request);
        if ($respone === false) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        if ($respone['success'] === false) {
            return $this->sendError($respone['data'], $respone['code']);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS, $respone['total']);
    }

    public function changePassword(ProfileRequest $request)
    {
        $respone = $this->profileRepository->changePassowrd($request);
        if (!isset($respone)) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        if ($respone['success'] === false) {
            return $this->sendError($respone['data'], CODE_BAD_REQUEST);
        }
        return $this->sendResponse($respone['data'], MSG_SUCCESS);
    }

    public function deleteProfile()
    {
        $respone = $this->profileRepository->deleteProfile();
        if (!isset($respone)) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        if ($respone['success'] === false) {
            return $this->sendError($respone['message'], CODE_BAD_REQUEST);
        }
        return $this->sendResponse($respone['message'], MSG_SUCCESS);
    }

    public function changeEmail(ProfileRequest $request)
    {

        $respone = $this->profileRepository->changeEmail($request);
        if (!isset($respone)) {
            return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
        }
        if ($respone['success'] === false) {
            return $this->sendError($respone['message'], CODE_BAD_REQUEST);
        }
        return $this->sendResponse($respone['message'], MSG_SUCCESS);
    }
}
