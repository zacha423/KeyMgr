<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 * 
 * @todo Advanced validation of the checkbox/switch input.
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleMembershipRequest extends FormRequest
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
      'additionMode' => ['nullable',], 
      'selectedData.*' => ['required', 'exists:user_roles,id'],
      'selectedUsers.*' => ['required', 'exists:users,id'],
    ];
  }
}
