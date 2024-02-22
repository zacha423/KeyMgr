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

class BuildingController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('building.building', [
      'buildings' => Building::all()->toArray(),
      'buildingsJSON' => Building::all()->toJson(),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('building.building', [
      'campus' => (Campus::all()->toArray()),
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
      'country' => $validated['Country'],
      'state' => $validated['State'],
      'city' => $validated['City'],
      'postalCode' => $validated['Zip'],
      'streetAddress' => $validated['Street'],
    ]);
    $campus = Campus::where(['id' => $validated['campus']])->first();
    $newBuilding = Building::firstOrNew(['name' => $validated['name']]);
    $newBuilding->address_id = $address->id;
    $campus->buildings()->save($newBuilding);

    return view('building.building', [
      'building' => $newBuilding->toArray(),
      'buildingJSON' => $newBuilding->toJson(),
      'campus' => $campus->toArray(),
      'campusJSON' => $campus->toJson(),
    ]);
  }

  /**
   * Display the specified resource.
   */
  public function show(Building $building)
  {
    return view('building.building', [
      'building' => $building->toArray(),
      'buildingJSON' => $building->toJson(),
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Building $building)
  {
    return view('building.building', [
      'building' => $building->toArray(),
      'buildingJSON' => $building->toJson(),
    ]);
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

    if(isset($validated['Country']))
    {
      $mapped['country'] = $validated['Country'];
    }
    if (isset($validated['State']))
    {
      $mapped['state'] = $validated['State'];
    }
    if(isset($validated['City']))
    {
      $mapped['city'] = $validated['City'];
    }
    if (isset ($data['Street']))
    {
      $mapped['streetAddress'] = $validated['Street'];
    }

    if (isset ($data['Zip']))
    {
      $mapped['postalCode'] = $validated['Zip'];
    }

    $addy = AddressWrapper::merge ($mapped, $building->address()->getRelated()->first());
    $building->address_id = $addy->id;
    $building->save();

    return view('building.building', [
      'building' => $building->toArray(),
      'buildingJSON' => $building->toJson(),
    ]);
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
