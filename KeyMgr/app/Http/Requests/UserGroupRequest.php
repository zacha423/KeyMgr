<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Requests;

use App\Models\UserGroup;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
    // return (dd($this));
    return [
      'parentGroup' => ['exists:App\Models\UserGroup,id'],
      'name' => ['required', 'string', 'max:50', Rule::unique(UserGroup::class)->ignore($this->route('group'))],

    ];
  }
}
