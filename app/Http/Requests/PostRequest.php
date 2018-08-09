<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'name' => 'required|unique:posts|min:3|max:100',
            'description' => 'required|unique:posts|min:300|max:5000',
            'post_type_id' => 'required|integer|exists:post_types,id',
            'image' => 'required|image|max:50000',
        ];
    }
}
