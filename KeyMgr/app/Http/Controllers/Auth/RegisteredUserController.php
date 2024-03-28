<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\UserGroup;
use App\Models\UserRole;

class RegisteredUserController extends Controller
{
  /**
   * Display the registration view.
   */
  public function create(): View
  {
    return view('auth.register');
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      'firstName' => ['required', 'string', 'max:255',],
      'lastName' => ['required', 'string', 'max:255',],
      'username' => ['required', 'unique:App\Models\User,username',],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255'], //email:rfc,dns,spoof
      'password' => ['required', 'confirmed', Rules\Password::defaults()], //, Password::min(self::PW_MIN_LEN)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
    ]);

    $user = User::create([
      'firstName' => $request->firstName,
      'lastName' => $request->lastName,
      'username' => $request->username,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

        $user->roles()->save(UserRole::where(['name' => config('constants.roles.default')])->first());
        $user->groups()->save(UserGroup::where(['name' => config('constants.groups.default')])->first());
        $user->save();

        event(new Registered($user));

    Auth::login($user);

    return redirect('/');
  }
}
