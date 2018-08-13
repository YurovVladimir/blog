<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CommRequest
 * @package App\Http\Requests
 *
 * @property-read integer $post_id
 * @property-read string $text
 */
class CommRequest extends FormRequest
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
            'text' => 'required|min:1|max:255',
            'post_id' => 'required|integer|exists:posts,id',
        ];
    }
}
