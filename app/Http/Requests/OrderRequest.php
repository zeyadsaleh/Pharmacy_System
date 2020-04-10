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
      'name' => 'required',
      'type' => 'required|exists:App\Medicine,type',
      'user' => 'required|exists:App\Client,name',
      'price' => 'required',
      'quantity' => 'required',
      'visa' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'user.required' => 'The UserName field is not valide',
      'user.exists' => 'The UserName field is not exist',
      'name.required' => 'Medicine name is required.',
      'type.required' => 'Type of medicine is required.'
    ];
  }
}
