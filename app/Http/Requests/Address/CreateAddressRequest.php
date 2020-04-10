<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class CreateAddressRequest extends FormRequest
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
            'street_name' => 'required',
            'building_name' => 'required',
            'floor_number' => 'required',
            'flat_number' => 'required',
            'is_main' => 'required|boolean',
            'user_id' => 'required|exists:clients,id',
            'area_id' => 'required|exists:areas,id',

        ];
    }
}
