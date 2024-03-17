<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKeyRequest;
use App\Http\Requests\UpdateKeyRequest;
use App\Models\Key;
use App\Models\KeyStatus;
use App\Models\KeyStorage;
use App\Models\KeyType;
use App\Models\Keyway;
use App\Models\Building;
use App\Models\Room;
use App\Models\Door;


class KeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('keys.keys', [
            'keys' => Key::all(),
            'keyStatuses' => KeyStatus::all(),
            'keyStorages' => KeyStorage::all(),
            'keyTypes' => KeyType::all(),
            'keyways' => Keyway::all(),
            'buildings' => Building::with('rooms.doors')->get(),
            'rooms' => Room::with('doors')->get(),
            'doors' => Door::all(),
        ]);
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
    public function store(StoreKeyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Key $key)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Key $key)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeyRequest $request, Key $key)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Key $key)
    {
        //
    }
}
