<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\StoreBuildingRequest;
use App\Http\Requests\UpdateBuildingRequest;
use App\Models\Building;
use App\Models\Wrappers\AddressWrapper;
use App\Models\Campus;
use App\Http\Resources\BuildingResource;
use Illuminate\Http\Request;


class BuildingController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
      return view('building.building', [
        'campuses' => (Campus::all()->toArray()),
        'buildings' => BuildingResource::collection(Building::with(AddressWrapper::loadRelationships(), 'buildings','rooms', 'campus')->get())->toArray(new Request()),
      ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('building.building', [
      'campuses' => (Campus::all()->toArray()),
      'campusJSON' => Campus::all()->toJson(),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreBuildingRequest $request)
  {
    $validated = $request->safe();
    $address = AddressWrapper::build([
      'country' => $validated['country'],
      'state' => $validated['state'],
      'city' => $validated['city'],
      'postalCode' => $validated['postalCode'],
      'streetAddress' => $validated['street'],
    ]);
    $campus = Campus::where(['id' => $validated['campus']])->first();
    $newBuilding = Building::firstOrNew(['name' => $validated['name']]);
    $newBuilding->address_id = $address->id;
    $newBuilding->save();
    
    $campus->buildings()->save($newBuilding);

    return view('building.building', [
      'buildings' => BuildingResource::collection(Building::with(AddressWrapper::loadRelationships(), 'buildings','rooms', 'campus')->get())->toArray(new Request()),
    ]);
  }

  /**
   * Display the specified resource.
   */
  public function show(Building $building)
  {
    return view('building.building', [
      'building' => (new BuildingResource($building->load(AddressWrapper::loadRelationships(), 'buildings','rooms', 'campus')))->toArray(new Request()),     
      'buildingJSON' => (new BuildingResource($building->load(AddressWrapper::loadRelationships(), 'buildings','rooms', 'campus')))->toJson(),
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Building $building)
  {
    return view('building.buildingEdit', [
      'building' => (new BuildingResource($building->load(AddressWrapper::loadRelationships(), 'buildings','rooms', 'campus')))->toArray(new Request()),
      'buildingJSON' => (new BuildingResource($building->load(AddressWrapper::loadRelationships(), 'buildings', 'rooms', 'campus')))->toJson(),    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateBuildingRequest $request, Building $building)
  {
    $validated = $request->safe();
    $mapped = array();

    if (isset($validated['campus']))
    {
      Campus::where (['id'=>$validated['campus']])->first()->buildings()->save($building);
    }

    if (isset ($validated['name']))
    {
      $building->name = $validated['name'];
    }

    if(isset($validated['country']))
    {
      $mapped['country'] = $validated['country'];
    }
    if (isset($validated['state']))
    {
      $mapped['state'] = $validated['state'];
    }
    if(isset($validated['city']))
    {
      $mapped['city'] = $validated['city'];
    }
    if (isset ($data['street']))
    {
      $mapped['streetAddress'] = $validated['street'];
    }

    if (isset ($data['postalCode']))
    {
      $mapped['postalCode'] = $validated['postalCode'];
    }

    $address = AddressWrapper::merge ($mapped, $building->address()->getRelated()->first());
    $building->save();
    $address->building()->save($building);

    return redirect()->route('building.index')->with('status', 'Building updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Building $building)
  {
    $building->delete();
    
    return view('building.building');
  }
}
