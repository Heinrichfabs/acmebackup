<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class personnelUpdateController extends FormRequest
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
        return [
            "full_name" => "required|min:5",
            "email" => "required",
            "password" => "required|min:5",
            "role" => "required|min:5",
            "images" => "required|mimes:jpg,png,jpeg,gif|max:5048",
        ];
    }
}
