<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
            'title' => 'bail|required|min:3',
            'category_id' => 'required|not_in:...',
            'image_path' => 'mimes:jpeg,jpg,png|max:5120',
            'description' => 'bail|required|between:5,180',
            'tags' => 'required'
        ];
    }
}
