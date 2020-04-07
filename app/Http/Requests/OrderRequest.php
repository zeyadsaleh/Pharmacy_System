<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
          // 'delivering_address' => 'required',
          'name' => 'required',
          'type' => 'required|exists:App\Medicine,type',
          'user_id' => 'required|exists:App\User,id',
          'status' => 'exists:App\Order,status',

      ];
    }

    public function messages(){
    $messages = [
    'user_id' => 'The UserName field is not valide',
    // 'delivering_address' => 'This user has'nt main address to Deliver the order',
      ];
    }
}
