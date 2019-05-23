<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            return [
                'email' => 'required|email|max:50|unique:users,email,' . $this->segment(4),
                //'first_name' => 'required',
                'last_name' => 'required',
            ];
        } elseif ($this->method() == 'POST') {
            return [
                'email' => 'required|email|max:50|unique:users,email',
                //'first_name' => 'required',
                'last_name' => 'required',
                'password' => 'required|min:8|max:20',
                'repassword' => 'same:password',
            ];
        }

    }
}
