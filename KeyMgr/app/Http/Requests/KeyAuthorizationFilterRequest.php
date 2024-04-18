<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Requests;

use Closure;

use Illuminate\Foundation\Http\FormRequest;

class KeyAuthorizationFilterRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    // Must be an admin user to access this page
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
      'holderSel.*' => ['nullable', 'exists:users,id'],
      'requestorSel' => ['nullable', 'exists:users,id'],
      'range' => [
        'string',
        'nullable',
        function (string $attribute, string $range, Closure $fail) {
          $dates = explode(' - ', $range);
          $startDate = (list ($startMonth, $startDay, $startYear) = explode('-', $dates[0]));
          $endDate = (list ($endMonth, $endDay, $year) = explode('-', $dates[1]));
          if (!checkDate($startMonth, $startDay, $startYear) || !checkdate($endMonth, $endDay, $year)) {
            $fail("The {$attribute} is not a date.");
          }
        },
      ],
      'buildingSel' => ['nullable','exists:buildings,id'],
      'roomSel.*' => ['nullable', 'exists:rooms,id'],
      'count' => ['nullable', 'integer', 'min:1'],
    ];
  }
}
