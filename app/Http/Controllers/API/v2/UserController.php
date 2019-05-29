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
}
