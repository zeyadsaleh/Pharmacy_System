<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:doctors,email',
            'password' => 'required|min:6',
            'national_id' => 'required|unique:doctors,national_id',
            'avatar' => 'image|mimes:jpg,jpeg'
        ];
    }

    public function messages() {
        return [
            // 'title.unique' => 'Title should be unique',
            // 'description.required' => 'Please Enter the description field',
            // 'title.required' => 'Please Enter the title field',
            // 'title.min' => 'Please the title has minimum of 3 characters',
            // 'description.min' => 'Please the description has minimum of 10 characters',
            // 'name.required' => 'Name is required',
            // 'email.required' => 'Email is required',
            // 'email.unique' => 'Email must be unique',
            // 'password.required' => 'Password is required',
            // 'national'
        ];
    }
}
