<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLockRequest;
use App\Http\Requests\UpdateLockRequest;
use App\Models\Lock;

class LockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLockRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Lock $lock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lock $lock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLockRequest $request, Lock $lock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lock $lock)
    {
        //
    }
}
