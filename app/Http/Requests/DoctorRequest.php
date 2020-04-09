<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Doctor;

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
        $doctor = Doctor::find($this->doctor);
        if($doctor)
            $user_id = $doctor->user->id;
        else
            $user_id = '';
        
        return [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email,'.$user_id,
            'password' => 'required|min:6',
            'national_id' => 'required|unique:doctors,national_id,' . $this->doctor,
            'avatar' => 'image|mimes:jpg,jpeg'
        ];
    }

    public function messages()
    {
        return [];
    }
}
