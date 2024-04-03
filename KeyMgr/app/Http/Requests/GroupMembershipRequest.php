<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 * 
 * @todo Advanced validation of the checkbox/switch input.
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupMembershipRequest extends FormRequest
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
      'additionMode' => ['nullable', ], //further testing TBD - would like to evaluate T/F/0/1 too.
      'selectedData.*' => ['required', 'exists:user_groups,id'],
      'selectedUsers.*' => ['required', 'exists:users,id'],
    ];
  }
}
