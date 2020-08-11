<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilterRequest extends FormRequest
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
            'ram' => 'nullable|max:255',
            'hardisk' => 'nullable|max:255',
            'location' => 'nullable|max:255',
            'minStorage' => 'nullable|integer',
            'maxStorage' => 'nullable|integer',
        ];
    }

    /**
     * Overriding protected method "failedValidation" method to return error to laravel api
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return Exception
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
