<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeyAuthorizationRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return $this->user()->isElevated();
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'holderSel_create' => ['required', 'exists:users,id'],
      'requestorSel_create' => ['required', 'exists:users,id'],
      'buildingSel' => ['nullable', 'exists:buildings,id'],
      'roomSel.*' => ['required', 'exists:rooms,id'],
      'dueDate' => ['required', 'date_format:m-d-Y'],
    ];
  }
}
