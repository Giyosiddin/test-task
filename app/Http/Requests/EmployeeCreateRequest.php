<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmployeeCreateRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
    throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
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
            'passport_serial' => 'required|max:10|min:6',
            'first_name' => 'required|string|min:3|max:15',
            'last_name' => 'required|string|min:3|max:15',
            'father_name' => 'string|min:3|max:15',
            'position' => 'required|string|min:5|max:50',
            'phone' => 'required|digits:10',
            'address' => 'required|string|min:2|max:150',
            'company_id' => 'required|numeric|exists:companies,id',
        ];
    }
}
