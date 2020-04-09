<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Pharmacy;

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
        $pharmacy = Pharmacy::find($this->pharmacy);
        if($pharmacy)
            $user_id = $pharmacy->user->id;
        else
            $user_id = '';

        return [
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$user_id,
            'password' => 'required|min:6',
            'national_id'=>'required|numeric|unique:pharmacies,national_id,' . $this->pharmacy,
            'avatar' => 'image|mimes:jpg,jpeg|nullable',
            'priority'=>'filled',
            'area_id'=>'filled'
        ];
    }
}
