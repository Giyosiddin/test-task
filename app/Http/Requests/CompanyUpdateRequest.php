<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CompanyUpdateRequest extends FormRequest
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
            'email' => 'email|unique:companies,email,'.$this->company_id,
            'phone' => 'digits:10',
            'address' => 'required|string|min:2|max:150',
            'manager_id' => 'required|numeric|exists:users,id',
            'website' => 'required|string|min:5|max:50',
            'company_name' => 'required|string',
            'supervisor' => 'required|string|min:5|max:100',
        ];
    }
}
