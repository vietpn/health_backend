<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Page;

class UpdatePageRequest extends FormRequest
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
        $segments = $this->segments();
        $id = intval(end($segments));
        return [
            'title' => 'required|min:5|max:150',
            'alias' => 'required|alpha_dash|min:5|max:150|unique:e_page,alias,' . $id
        ];
    }
}
