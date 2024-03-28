<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserGroupRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   * @todo Add RBAC - if user is admin
   */
  public function authorize(): bool
  {
    $OVERRIDE = true;
    
    return $OVERRIDE;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'parentGroup' => ['exists:App\Models\UserGroup,id'],
      'groupName' => ['required','string','max:50','unique:App\Models\UserGroup,name']
    ];
  }
}
