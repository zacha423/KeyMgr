<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\StoreBuildingRequest;
use App\Http\Requests\UpdateBuildingRequest;
use App\Models\Building;

class BuildingController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('building.building', ['buildings' => Building::all()->toJson(), 'building' => '']);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('building.building', ['buildings' => '', 'building' => '']);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreBuildingRequest $request)
  {
    return view('building.building', ['buildings' => '', 'building' => '']);
  }

  /**
   * Display the specified resource.
   */
  public function show(Building $building)
  {
    return view('building.building', ['buildings' => '', 'building' => $building->toJson()]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Building $building)
  {
    return view('building.building', ['buildings' => '', 'building' => $building->toJson()]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateBuildingRequest $request, Building $building)
  {
    return view('building.building', ['buildings' => '', 'building' => $building->toJson()]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Building $building)
  {
    $building->delete();
    
    return view('building.building', ['buildings' => '', 'building' => $building->toJson()]);
  }
}
