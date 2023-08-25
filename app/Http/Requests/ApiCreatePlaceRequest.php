<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;


class ApiCreatePlaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'place' => 'required|max:100',
            'description' => 'required|max:255'
        ];
    }

    public function failedValidation(Validator $validator) {
        $response = response([
                                'status' => 'ERROR',
                                'message' => 'Validation criteria did not met',
                                'errors' => $validator->errors()
                            ], 422);
        
        throw new ValidationException($validator, $response);
    }
}
