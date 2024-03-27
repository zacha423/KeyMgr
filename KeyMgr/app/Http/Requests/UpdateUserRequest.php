<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true; //init=false, true for test/debug
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'firstName' => ['string','nullable'],
      'lastName' => ['string','nullable'],
      'username' => ['required', Rule::unique(User::class)->ignore(User::find(['id' => $this->route('user')])->first())],
      // Email not yet validated beyond required to facilitate easier test account creation. :)
      'email' => ['email','nullable',],
      // 'email' => ['string', 'nullable', 'email:rfc,dns,spoof'], //When ready to filter replace above line.
      // 'password' => ['confirmed'],//, Password::min(self::PW_MIN_LEN)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
    ];
  }
}
