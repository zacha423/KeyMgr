<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Response;

class UserAPIController extends Controller
{
    /**
     * Get a JSON representation of all users.
     * 
     * TO DO: Add support for pagination
     */
    public function index()
    {
        return new UserCollection(User::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
      // $User = User::factory()->create($request->safe()->toArray());
      // $err = $request->messages();
      // response:
      // http code 201
      // URI goes in the Location header
      // return $request->safe();
      return 'test';
      // return Response('', 201)->header('Content-Type', 'text/plain')->header('location',"/accounts/{$User->toArray()['id']}");

    }

    /**
     * Display the specified resource.
     */
    public function show(User $account)
    {
        // return new UserResource($account);
        return $account->toJson();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
