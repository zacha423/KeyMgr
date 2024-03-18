<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreKeyRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'keyLevel' => ['required', 'alpha', ],
      'keySystem' => ['required', 'alpha-num',],
      'copyNumber' => ['required', 'max:65535','min:0','integer'],
      'bitting' => ['alpha-num','nullable',],
      'blindCode' => ['alpha-num','nullable',],
      'mainAngles' => ['alpha-num','nullable',],
      'doubleAngles' => ['alpha-num','nullable',],
      'replacementCost' => ['min:0','nullable','decimal:2,4',],
      'key_status_id' => ['required','exists:keyways,id'],
      'keyway_id' => ['required','exists:key_statuses,id'],
      'key_type_id' => ['required','exists:key_types,id'],
      'storage_hook_id' => ['required','exists:storage_hooks,id']
    ];
  }
}
