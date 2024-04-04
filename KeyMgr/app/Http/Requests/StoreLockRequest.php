<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLockRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return false;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'numPins' => ['required', 'min:0', 'max:15'],
      'upperPinLengths' => ['required', 'alpha-num'],
      'lowerPinLengths' => ['required', 'alpha-num'],
      'installDate' => ['required'],
      'keywayid' => ['exists:keyways,id', 'required'],
      'lockmodel_id' => ['exists:lock_models,id', 'required'],
    ];
  }
}
