<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   * 
   * @todo RBAC
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
      'number' => ['required', 'string', 'max:255'],
      'roomDesc' => ['string', 'max:255'],
      'building' => ['exists:App\Models\Building,id'],
      
      'doorDesc' => ['string','max:255'],
      'doorHWDesc' => ['string', 'max:255'],
    ];
  }
}
