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
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$this->client,
            'password' => 'required|min:6',
            'national_id' => 'required|unique:clients,national_id,'.$this->client,
            'avatar' => 'image|mimes:jpg,jpeg'
        ];
    }
}
