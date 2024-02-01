<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function __construct() //temporary for testing
    {
        $this->middleware("auth")->except(["index","store","create","update","show","edit"]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        // return view ('viewpath/viewname');
        return view ('accounts/index');
        // return redirect ('/'); //do your logic to render a blade here.
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('accounts/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
        return redirect ('/accounts');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view ('accounts/show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view ('accounts/edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        return redirect ('/accounts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //needs delete header, later problem
    }
}
