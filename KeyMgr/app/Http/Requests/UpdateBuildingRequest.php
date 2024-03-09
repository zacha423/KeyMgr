<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBuildingRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
    // Locksmtih/Admin/KeyIssuer
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    $buildingRules = [
      'campus' => ['exists:App\Models\Campus,id'],
      'name' => ['string', 'max:255'],
    ];
    
    return array_merge ($buildingRules, AddressRules::updateRules ());
  }
}
