<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsrAdrsRequest extends FormRequest
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
            'user_id'=>'exists:clients,id',
            'street_name'=>'required',
            'building_name'=>'required',
            'floor_number'=>'present',
            'flat_number'=>'present',
            'is_main'=>'nullable'
        ];
    }
}
