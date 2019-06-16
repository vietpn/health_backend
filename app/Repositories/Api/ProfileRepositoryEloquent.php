<?php

namespace App\Repositories\Api;

use App\Models\OauthAccessTokens;
use App\User;
use InfyOm\Generator\Common\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use DB;

/**
 * Class ProfileRepositoryRepositoryEloquent
 * @package namespace App\Repositories\Api;
 */
class ProfileRepositoryEloquent extends BaseRepository implements ProfileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    public function model()
    {
        return User::class;
    }

    public function checkLogIn($username, $password)
    {
        if (\Auth::attempt(['username' => $username, 'password' => $password])) {
            $user = \Auth::user();
            $user['token'] = $user->createToken('health')->accessToken;
            return [
                # 'status'    =>  CODE_SUCCESS,
                'message' => MSG_SUCCESS,
                'data' => $user,
            ];
        } else {

            #return $this->sendError(MSG_UNAUTHORIZED,CODE_UNAUTHORIZED);
        }

        #return $username;
        // TODO: Implement checkLogIn() method.
    }

    public function changePassword($request)
    {
        try {
            $profile = $this->getInfor();
            $newPassword = $request->input('new_password', "");
            $input['password'] = $newPassword;
            $profileUpdate = $this->update($input, $profile->id);
            if (!isset($profileUpdate)) {
                return [
                    'success' => false,
                    'data' => ""
                ];
            }
            $profile['token'] = $profile->createToken('health')->accessToken;
            $this->updateAccessToken($profile);

            return [
                'success' => true,
                'data' => $profile
            ];
        } catch (\Exception $ex) {
            return [
                'success' => false,
                'data' => $ex->getMessage()
            ];
        }


    }

    public function getInfor()
    {
        // TODO: Implement getInfor() method.
        $user = \Auth::user();

        return $user;
    }

    public function getByUserId($id)
    {
        try {
            $user = User::find(intval($id));
            if (!isset($user)) {
                throw new \Exception("User not exist", 422);
            }
            return $user;
        } catch (\Exception $ex) {
            return [
                'success' => false,
                'data' => $ex->getMessage(),
            ];
        }

    }

    public function updateAccessToken($user)
    {
        //Get Oauth Access tokens moi nhat
        $oatTmp = OauthAccessTokens::where(['user_id' => $user->id])->orderBy('created_at', 'DESC')->first();
        if (isset($oatTmp)) {
            $oat = new OauthAccessTokens();
            $oat->id = $oatTmp->id;
            $oat->user_id = $oatTmp->user_id;
            $oat->client_id = $oatTmp->client_id;
            $oat->name = $oatTmp->name;
            $oat->scopes = $oatTmp->scopes;
            $oat->revoked = $oatTmp->revoked;
            $oat->created_at = $oatTmp->created_at;
            $oat->updated_at = $oatTmp->updated_at;
            $oat->token = $user->token;
            $oat->expires_at = $oatTmp->expires_at;

            //Delete other this user accesstoken
            DB::table('oauth_access_tokens')->where('user_id', '=', $user->id)->delete();

            $oat->save();
        }
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
