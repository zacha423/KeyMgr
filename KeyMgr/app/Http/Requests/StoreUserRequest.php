<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illluminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
  const PW_MIN_LEN = 8;
  /**
   * Determine if the user is authorized to make this request.
   * 
   * Because we want users to self-register an account everyone is authorized.
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
      'firstName' => 'required',
      'lastName' => 'required',
      'username' => ['required', 'unique:App\Models\User,username'],
      // Email not yet validated to facilitate easier test accounts :)
      'email' => ['required'/*, 'email:rfc,dns,spoof'*/],
      'password' => ['required', 'confirmed', Password::min(self::PW_MIN_LEN)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
    ];
  }
}
