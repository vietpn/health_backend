<?php

namespace App\Http\Requests\API;

use App\Models\Message;
use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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

            case 'api.v2.user.updateStatusMsg':
                $rules = Message::$updateStatusMsg;
                break;
            case 'api.v2.user.updateStatusAllMsg':
                $rules = Message::$ruleUpdateAll;
                break;
            case 'api.v2.user.sentMessage':
                $rules = Message::$ruleSentMessage;
                break;
            default:
                $rules = Message::$updateStatusMsg;
                break;
        }

        return $rules;
    }
}
