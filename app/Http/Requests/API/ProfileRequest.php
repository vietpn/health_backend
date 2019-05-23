<?php

namespace App\Http\Requests\API;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use InfyOm\Generator\Request\APIRequest;

class ProfileRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $route = \Route::currentRouteName();
        switch ($route) {
            case 'api.v1.user.register':
                $rules = User::$rulesRegisterProfileUser;
                break;
            case 'api.v2.user.uploadAvatar':
                $rules = User::$rulesUploadAvatar;
                break;
            case 'api.v2.user.updateProfile':
                $rules = User::$ruleUpdateProfile;
                break;
            case 'api.v2.user.searchProfile':
                $rules = User::$rulesSearchProfile;
                break;
            case 'api.v2.user.block':
                $rules = [];
                break;
            case 'api.v2.user.unBlock':
                $rules = User::$ruleUnBlockProfile;
                break;
            case 'api.v2.user.favorite':
                $rules = User::$ruleFavoriteProfile;
                break;
            case 'api.v2.user.unFavorite':
                $rules = User::$ruleUnFavoriteProfile;
                break;
            case 'api.v2.user.report':
                $rules = User::$ruleReportProfile;
                break;
            case 'api.v1.user.registerBusiness':
                $rules = User::$rulesRegisterProfileBusiness;
                break;
            case 'api.v2.user.updateOnline':
                $rules = User::$rulesOnlineStatus;
                break;
            case 'api.v1.user.resetPassword':
                $rules = User::$rulePasswordReset;
                break;
            case 'api.v2.user.updateLocation':
                $rules = User::$ruleUpdateLocation;
                break;
            case 'api.v2.user.buyItem':
                $rules = User::$buyItem;
                break;
            case 'api.v2.user.itemListByUser':
                $rules = User::$itemListByUser;
                break;
            case 'api.v2.user.favorite-post':
                $rules = User::$ruleFavoritePost;
                break;
            case 'api.v2.user.unFavorite-post':
                $rules = User::$ruleUnFavoritePost;
                break;
            case 'api.v2.user.searchFavoriteProfile':
                $rules = User::$rulesSearchFavoriteProfile;
                break;
            case 'api.v2.user.listFavoritePost':
                $rules = [];
                break;
            case 'api.v2.user.donatePoint':
                $rules = User::$rulesDonatePoint;
                break;
            case 'api.v2.user.categoryListByUser':
                $rules = [];
                break;
            case 'api.v2.user.changePassword':
                $rules = [
                    /*'old_password' =>   'required|old_password:'. \Auth::user()->password,*/
                    'password' => 'required|min:6',
                ];
                break;
            case 'api.v2.user.changeEmail':
                $rules = User::$ruleChangeEmail;
                break;
            default:
                $rules = User::$rulesLogin;
                break;
        }

        return $rules;
    }
}
