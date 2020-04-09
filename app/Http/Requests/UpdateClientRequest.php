<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'name' => 'filled',
            'email' => 'filled|email:rfc,dns|unique:users,email',
            'gender' => [
                'filled',
                Rule::in(['Male', 'Female']),
            ],
            'password' => 'filled|min:6|confirmed',
            'password_confirmation' => 'filled|same:password',
            'date_of_birth' => 'filled|date',
            'avatar' => 'filled|image|mimes:jpg,jpeg',
            'mobile_number' => 'filled|numeric',
            'national_id' => 'filled|unique:clients|numeric',
        ];
    }

    public function messages() {
        return [
            'gender.in' => 'Gender should be either Male or Female'
        ];
    }
}
