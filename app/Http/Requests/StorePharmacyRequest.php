<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacyRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required|email',
            'password' => 'required|min:6',
            'national_id'=>'required|numeric',
            'avatar' => 'image|mimes:jpg,jpeg|nullable',
            'priority'=>'present',
            'area_id'=>'present'
        ];
    }
}
