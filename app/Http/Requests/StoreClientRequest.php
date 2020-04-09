<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
        // return [
        //     'name' => 'required',
        //     'email' => 'required|unique:users,email,'.$this->client,
        //     'password' => 'required|min:6',
        //     'national_id' => 'required|unique:clients,national_id,'.$this->client,
        //     'avatar' => 'image|mimes:jpg,jpeg'
        // ];
        return [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'gender' => [
                'required',
                Rule::in(['Male', 'Female']),
            ],
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|same:password',
            'date_of_birth' => 'required|date',
            'avatar' => 'required|image|mimes:jpg,jpeg',
            'mobile_number' => 'required|numeric',
            'national_id' => 'required|unique:clients|numeric',
        ];
    }

    public function messages() {
        return [
            'gender.in' => 'Gender should be either Male or Female'
        ];
    }
}
