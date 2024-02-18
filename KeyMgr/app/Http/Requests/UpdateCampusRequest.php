<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCampusRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   * 
   * @todo Implement RBAC
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
    $stringVal = ['string', 'max:255'];

    return [
      'Country' => $stringVal,
      'State' => $stringVal,
      'City' => $stringVal,
      'Street' => $stringVal,
      'Zip' => $stringVal,
      'name' => $stringVal,
    ];
  }
}
