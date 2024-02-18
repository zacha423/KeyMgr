<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\StoreCampusRequest;
use App\Http\Requests\UpdateCampusRequest;
use App\Models\Campus;
use App\Models\Wrappers\AddressWrapper;

class CampusController extends Controller
{
  /**
   * Display a listing of the campuses.
   */
  public function index()
  {
    return view('campus.campusForm', [
      'campuses' => Campus::all()->toJson(),
      'campus' => '',
    ]);
  }

  /**
   * Show the form for creating a new campus.
   */
  public function create()
  {
    return view('campus.campusForm', [
      'campuses' => '',
      'campus' => '',
    ]);
  }

  /**
   * Store a newly created campus in storage.
   */
  public function store(StoreCampusRequest $request)
  {
    $val = $request->safe();
    $address = AddressWrapper::build ([
      'country' => $val['Country'],
      'state' => $val['State'],
      'city' => $val['City'],
      'postalCode' => $val['Zip'],
      'streetAddress' => $val['Street'],
    ]);
    $camp = Campus::firstOrNew(['name' => $val['name']]);
    $camp->address_id = $address->id;
    $camp->save();

    return view('campus.campusForm', [
      'campuses' => '',
      'campus' => $camp->toJson(),
    ]);
  }

  /**
   * Display the specified campus.
   */
  public function show(Campus $campus)
  {
    return view('campus.campusForm', [
      'campuses' => '',
      'campus' => $campus->toJson(),
    ]);
  }

  /**
   * Show the form for editing the specified campus.
   */
  public function edit(Campus $campus)
  {
    return view('campus.campusForm', [
      'campuses' => '',
      'campus' => $campus->toJson(),
    ]);
  }

  /**
   * Update the specified campus in storage.
   */
  public function update(UpdateCampusRequest $request, Campus $campus)
  {
    $data = $request->safe();

    if (isset ($data['name'])) 
    {
      $campus->name = $data['name'];
    }



    $campus->save();

    return view('campus.campusForm', [
      'campuses' => '',
      'campus' => $campus->toJson(),
    ]);
  }

  /**
   * Remove the specified campus from storage.
   * 
   * @todo Add dependency verification/mitigation. E.g. cascade or nah?
   */
  public function destroy(Campus $campus)
  {
    $campus->delete ();

    return redirect ('/campus');
  }
}
