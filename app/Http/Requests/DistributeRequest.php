<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DistributeRequest
 * @package App\Http\Requests
 *
 * @property-read integer $m
 * @property-read integer $n
 *
 */
class DistributeRequest extends FormRequest
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
            'm' => 'required|integer|gte:n',
            'n' => 'required|integer',
        ];
    }
}
