<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 * @author Maximus Hudson <huds4450@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Http\Resources\BuildingResource;
use App\Http\Resources\RoomResource;
use App\Models\Wrappers\AddressWrapper;
use App\Models\Room;
use App\Models\Building;
use App\Models\Door;
use Illuminate\Http\Request;

class RoomController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $data = [];

    foreach (Room::all()->load('doors', 'building') as $room) {
      $roomRes = (new RoomResource($room))->toArray($request);

      $btnEdit = '<a href="' . route('building.edit', $room->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
      <i class="fa fa-lg fa-fw fa-pen"></i>
      </a>';
      $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete" data-key-id="' . $room->id . '">
            <i class="fa fa-lg fa-fw fa-trash"></i>
        </button>';
      $btnDetails = '<a href="' . route('building.show', $room->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
            <i class="fa fa-lg fa-fw fa-eye"></i>
      </a>';

      array_push($data, [
        'id' => $room->id,
        'number' => $room->number,
        'description' => $room->description,
        'buildingName' => $roomRes['buildingName'],
        'doorDesc' => $room->doorDesc,
        'doorHWDesc' => $room->doorHWDesc,
        'actions' => '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>',
      ]);
    }
    return view('room.rooms', [
      // 'rooms' => RoomResource::collection(Room::with('doors', 'building')->get())->toArray(new Request()),
      'rooms' => $data,
      'buildings' => BuildingResource::collection(
        Building::with(
          AddressWrapper::loadRelationships(),
          'buildings',
          'rooms',
          'campus'
        )->get()
      )->toArray(new Request()),
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
    $room->building_id = $validated['building'];

    $room->save();

    $door = Door::firstOrNew([
      'description' => $validated['doorDesc'],
      'hardwareDescription' => $validated['doorHWDesc'],
    ]);
    $door->room_id = $room->id;
    $door->save();

    return redirect('/room');
  }

  /**
   * Display the specified resource.
   */
  public function show(Room $room)
  {
    $room->load('doors', 'building');

    $door = $room->doors()->first();

    return view('room.singleRoom', [
      'room' => (new RoomResource($room)),
      'door' => $door,
    ]);
  }


  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Room $room)
  {
    /**
     * @todo See if possible to preselect existing Building and include possible list
     */
    return view('room.roomEdit', [
      'buildings' => BuildingResource::collection(
        Building::with(
          AddressWrapper::loadRelationships(),
          'buildings',
          'rooms',
          'campus'
        )->get()
      )->toArray(new Request()),
      'room' => (new RoomResource($room->load('doors', 'building'))),
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(RoomRequest $request, Room $room)
  {
    $validated = $request->safe();

    if (isset ($validated['number'])) {
      $room->number = $validated['number'];
    }

    if (isset ($validated['roomDesc'])) {
      $room->description = $validated['roomDesc'];
    }

    if (isset ($validated['building'])) {
      $room->building_id = $validated['building'];
    }

    $room->save();

    // This is bad, and probably should be wrapped.
    $door = $room->doors()->getRelated()->first();

    if (isset ($validated['doorDesc'])) {
      $door->description = $validated['doorDesc'];
    }

    if (isset ($validated['doorHWDesc'])) {
      $door->hardwareDescription = $validated['doorHWDesc'];
    }

    $door->save();

    return redirect('/room/' . $room->id);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Room $room)
  {
    $room->delete();

    return redirect('/room');
  }
}
