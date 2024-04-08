<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLockRequest extends FormRequest
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
      'numPins' => ['required', 'min:0', 'max:15'],
      'upperPinLengths' => ['required', 'numeric'],
      'lowerPinLengths' => ['required', 'numeric'],
      'installDate' => ['required'],
      'keyway_id' => ['exists:keyways,id', 'required'],
      'room' => ['exists:rooms,id', 'required'],
      'lockmodel_id' => ['exists:lock_models,id', 'required']
    ];
  }
}
