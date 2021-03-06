<?php

namespace App\Http\Controllers\API\v1;

use App\Define\Systems;
use App\Events\UserLogin;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\ProfileRequest;
use App\Models\BaseModel;
use App\Models\BloodType;
use App\Models\OauthAccessTokens;
use App\Models\ZodiacSigns;
use App\Repositories\Api\ProfileRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use phpseclib\Crypt\Hash;
use Response;

class UserController extends AppBaseController
{
    protected $profileRepository;
    protected $content;

    public function __construct(ProfileRepository $profileRepositoryRepository)
    {
        $this->profileRepository = $profileRepositoryRepository;
        $this->content = array();
    }

    /**
     * @param ProfileRequest $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function login(ProfileRequest $request)
    {
        try {
            $email = $request->input('email', "");
            $username = $request->input('username', "");
            $password = $request->input('password', "");
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Auth::attempt(
                    [
                        'email' => $email,
                        'password' => $password,
                    ]
                );
            } else {
                Auth::attempt(
                    [
                        'username' => $username,
                        'password' => $password,
                    ]);
            }
            if (Auth::check()) {
                $user = $this->profileRepository->getInfor();
                //update last login
                event(new UserLogin($user->id));
                $user['token'] = $user->createToken('health')->accessToken;
                //Get Oauth Access tokens moi nhat
                $this->profileRepository->updateAccessToken($user);
                // Get all config
                // $user['config'] = array();
            } else {
                return $this->sendError(MSG_UNAUTHORIZED, CODE_UNAUTHORIZED);
            }

            return $this->sendResponse($user, MSG_SUCCESS);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function changePassword(ProfileRequest $request)
    {
        try {
            $email = $request->input('email', "");
            $username = $request->input('username', "");
            $password = $request->input('password', "");
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Auth::attempt(
                    [
                        'email' => $email,
                        'password' => $password,
                    ]
                );
            } else {
                Auth::attempt(
                    [
                        'username' => $username,
                        'password' => $password,
                    ]);
            }
            if (Auth::check()) {
                $respone = $this->profileRepository->changePassword($request);
                if (!isset($respone)) {
                    return $this->sendError(MSG_BAD_REQUEST, CODE_BAD_REQUEST);
                }
                if ($respone['success'] === false) {
                    return $this->sendError($respone['data'], CODE_BAD_REQUEST);
                }
                return $this->sendResponse($respone['data'], MSG_SUCCESS);
            } else {
                return $this->sendError(MSG_UNAUTHORIZED, CODE_UNAUTHORIZED);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
