<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Http\Resources\BuildingResource;
use App\Http\Resources\CampusResource;
use App\Http\Resources\RoomResource;
use App\Models\Wrappers\AddressWrapper;
use App\Models\Room;
use App\Models\Building;
use App\Models\Campus;
use App\Models\Door;
use Illuminate\Http\Request;

class RoomController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('room.rooms', [
      'rooms' => RoomResource::collection(Room::with('doors', 'building')->get())->toArray(new Request()),
      'roomsJSON' => Room::all()->toJson(),
      'buildings' => BuildingResource::collection(Building::with(AddressWrapper::loadRelationships(), 'buildings','rooms', 'campus')->get())->toArray(new Request()),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('room.rooms', [
      'campuses' => CampusResource::collection(Campus::all()),
      'campusesJSON' => CampusResource::collection(Campus::all())->toJson(),
      'buildings' => BuildingResource::collection(Building::with(AddressWrapper::loadRelationships(), 'buildings','rooms', 'campus')->get())->toArray(new Request()),
      'buildingsJSON' => BuildingResource::collection(Building::all())->toJson(),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(RoomRequest $request)
  {
    $validated = $request->safe();

    $room = Room::firstOrNew([
      'number' => $validated['number'],
      'description' => $validated['roomDesc']
    ]);
    $room->building_id = $validated['building_id'];
    
    $room->save();

    $door = Door::firstOrNew([
      'description' => $validated['doorDesc'],
      'hardwareDescription' => $validated['doorHWDesc'],
    ]);
    $door->room_id = $room->id;
    $door->save();

    return view('room.rooms', [
      'room' => $room->toArray(),
      'roomJSON' => $room->toJson(),
      'building' => new BuildingResource(Building::where(['id' => $validated['building']])->first()),
      'buildingJSON' => (new BuildingResource(Building::where(['id' => $validated['building']])->first()))->toJson(),
    ]);
  }

  /**
   * Display the specified resource.
   */
  public function show(Room $room)
  {
    return view('room.rooms', [
      'rooms' => RoomResource::collection(Room::with('doors', 'building')->get())->toArray(new Request()),
      'room' => $room->load('doors')->toArray(),
      'building' => $room->building()->first(),
      'buildings' => BuildingResource::collection(Building::with(AddressWrapper::loadRelationships(), 'buildings','rooms', 'campus')->get())->toArray(new Request()),
      'roomJSON' => $room->load('doors')->toJson(),
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Room $room)
  {
    return view('room.roomEdit', [
      'rooms' => RoomResource::collection(Room::with('doors', 'building')->get())->toArray(new Request()),
      'room' => $room->load('doors')->toArray(),
      'roomJSON' => $room->load('doors')->toJson(),
      'building' => $room->building()->first(),
      'campuses' => CampusResource::collection(Campus::all()),
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(RoomRequest $request, Room $room)
  {
    $validated = $request->safe();

    if (isset($validated['number']))
    {
      $room->number=$validated['number'];
    }
    
    if(isset($validated['roomDesc']))
    {
      $room->description = $validated['roomDesc'];
    }

    $room->save();
    
    // This is bad, and probably should be wrapped.
    $door = $room->doors()->getRelated()->first(); 
    
    if (isset($validated['doorDesc']))
    {
      $door->description = $validated['doorDesc'];
    }

    if (isset($validated['doorHWDesc']))
    {
      $door->hardwareDescription = $validated['doorHWDesc'];
    }

    $door->save();

    return view('room.rooms', [
      'room' => $room->load('doors')->toArray(),
      'rooms' => RoomResource::collection(Room::with('doors', 'building')->get())->toArray(new Request()),
      'buildings' => BuildingResource::collection(Building::with(AddressWrapper::loadRelationships(), 'buildings','rooms', 'campus')->get())->toArray(new Request()),
      'roomJSON' => $room->toJson(),
      'door'=>$door->toArray(),
      'doorJSON'=>$door->toJson(),
    ]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Room $room)
  {
    $room->delete();

    return view('room.rooms');
  }
}
