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
use App\Models\Wrappers\BuildingWrapper;
use Illuminate\Http\Request;


class BuildingController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
      $data = [];
  
      foreach (Building::all() as $building2) {
          $building = (new BuildingResource($building2));
          $user4 = $building->toArray(new Request ());
          $btnEdit = '<a href="' . route('building.edit', $building->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
              <i class="fa fa-lg fa-fw fa-pen"></i>
          </a>';
          $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete" data-key-id="' . $building->id . '">
              <i class="fa fa-lg fa-fw fa-trash"></i>
          </button>';
          $btnDetails = '<a href="' . route('building.show', $building->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
              <i class="fa fa-lg fa-fw fa-eye"></i>
          </a>';
  
          array_push($data, [
              'id' => $building->id,
              'name' => $building->name,
              'country' => $building->address->city->state->country->name,
              'state' => $building->address->city->state->name,
              'city' => $building->address->city->name,
              'postalCode' => $building->address->zipcode->code,
              'streetAddress' => $building->address->streetAddress,
              'campus' => $building->campus->name,
              'actions' => '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'
          ]);
      }
  
      return view('building.building', [
          'buildings' => $data,
          'buildingJSON' => Building::all()->toJson(),
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
      'streetAddress' => $validated['streetAddress'],
    ]);

    $campus = Campus::where(['id' => $validated['campus']])->first();
    $newBuilding = Building::firstOrNew(['name' => $validated['name']]);
    $newBuilding->address_id = $address->id;
    $campus->buildings()->save($newBuilding);

    $newBuilding->save();
    return redirect('/building');
  }

  /**
   * Display the specified resource.
   */
  public function show(Building $building)
  {
    return view('building.singleBuilding', [
      'building' => (new BuildingResource($building->load(
        BuildingWrapper::loadRelationships()
      )))->toArray(new Request()),
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Building $building)
  {
    return view('building.buildingEdit', [
      'campuses' => (Campus::all()->toArray()),
      'building' => (new BuildingResource($building->load(
        BuildingWrapper::loadRelationships()
      )))->toArray(new Request()),
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateBuildingRequest $request, Building $building)
  {
    $validated = $request->safe();
    $mapped = array();

    if (isset ($validated['campus'])) {
      Campus::where(['id' => $validated['campus']])->first()->buildings()->save($building);
    }

    if (isset ($validated['name'])) {
      $building->name = $validated['name'];
    }

    if (isset ($validated['country'])) {
      $mapped['country'] = $validated['country'];
    }
    if (isset ($validated['state'])) {
      $mapped['state'] = $validated['state'];
    }
    if (isset ($validated['city'])) {
      $mapped['city'] = $validated['city'];
    }
    if (isset ($validated['streetAddress'])) {
      $mapped['streetAddress'] = $validated['streetAddress'];
    }

    if (isset ($validated['postalCode'])) {
      $mapped['postalCode'] = $validated['postalCode'];
    }

    $address = AddressWrapper::merge($mapped, $building->address()->getRelated()->first());
    $building->save();
    $address->building()->save($building);

    return redirect()->route('building.index')->with('status', 'Building updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Building $building)
  {
    /**
     * @todo test this
     */
    $building->delete();

    return view('building.building');
  }
}
