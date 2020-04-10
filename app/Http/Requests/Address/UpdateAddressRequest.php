<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            'street_name' => 'filled',
            'building_name' => 'filled',
            'floor_number' => 'filled',
            'flat_number' => 'filled',
            'is_main' => 'filled|boolean',
            'user_id' => 'filled|exists:clients,id',
            'area_id' => 'filled|exists:areas,id',

        ];
    }

   
}
