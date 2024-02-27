<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 * 
 * Purpose: This controller can be used for managing user management. 
 * Basic login/authentication should be done through Breeze's controllers.
 */
namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\UserAPIController as UserAPI;
class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // $users = User::all();
    
    return view('accounts/index');
    //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('accounts/create');
  }

  /**
   * @todo Once we are ready to implement user management reevaluate data validation
   * Store a newly created resource in storage.
   * 
   * Expected form data:
   * firstName             - the first name of the user
   * lastName              - the last name of the user
   * username              - the username for the account
   * email                 - the user's email address
   * password              - the user's password
   * password_confirmation - confirming the user's password
   */
  public function store(StoreUserRequest $request)
  {
    // $validated = $request->safe();
    // User::factory()->create($validated->toArray());
    
    
    return redirect('/');
  }

  /**
   * Display the specified resource.
   */
  public function show(User $account)
  {
    return view('accounts/show', ['account'=>$account->toJson(),]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $account)
  {
    return view('accounts/edit', ['user' => $account->toJson()]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateUserRequest $request, User $account)
  {
    $data = $request->safe();

    if (isset ($data['firstName'])) {
      $account->firstName = $data['firstName'];
    }

    if (isset ($data['lastName'])) {
      $account->lastName = $data['lastName'];
    }

    if (isset ($data['username'])) {
      $account->username = $data['username'];
    }

    if (isset ($data['email'])) {
      $account->email = $data['email'];
    }

    if (isset ($data['password'])) {
      $account->password = $data['password'];
    }

    $account->save ();

    return redirect("/accounts/$account->id");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $account): RedirectResponse
  {
    $account->delete();

    return redirect('/accounts');
  }
}
