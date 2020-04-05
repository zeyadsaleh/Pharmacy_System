<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
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
            'pharmacy_id'=>'exists:pharmacies,id',
            'email' => 'required|unique:doctors,email',
            'password' => 'required|min:6',
            'national_id' => 'required|unique:doctors,national_id',
            'avatar' => 'image|mimes:jpg,jpeg',
        ];
    }
}
