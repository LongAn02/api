<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'bail|required',
            'email' => [
                'bail',
                'required',
                'string',
                'email',
                Rule::unique('users' , 'email')->ignore(request('id'))
            ],
            'password' => 'bail|required',
            'phone' => [
                'bail',
                'required',
                Rule::unique('users' , 'phone')->ignore(request('id'))
            ],
            'address' => 'bail|required',
            'age' => 'bail|required|max:2|min:2',
            'sex' => 'bail|required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new Response([
            'errors' => $validator->errors()
        ], Response::HTTP_UNPROCESSABLE_ENTITY);

        throw (new ValidationException($validator, $response));
    }
}
