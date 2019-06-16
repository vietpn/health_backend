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
            case 'api.v1.user.changePassword':
                $rules = [
                    'password' => 'required|min:3',
                    'new_password' => 'required|min:3',
                ];
                break;
            default:
                $rules = User::$rulesLogin;
                break;
        }

        return $rules;
    }
}
