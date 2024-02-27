<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules(): array
  {
    return [
      'firstName' => ['required', 'string', 'max:255',],
      'lastName' => ['required', 'string', 'max:255',],
      'username' => ['required', Rule::unique(User::class)->ignore($this->user()->id)],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255'], //email:rfc,dns,spoof
      'password' => ['required', 'confirmed', Rules\Password::defaults()], //, Password::min(self::PW_MIN_LEN)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
    ];
  }
}
