<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\StoreCampusRequest;
use App\Http\Requests\UpdateCampusRequest;
use App\Http\Resources\CampusResource;
use App\Models\Campus;
use App\Models\Wrappers\AddressWrapper;

class CampusController extends Controller
{
  /**
   * Display a listing of the campuses.
   * 
   * @todo Update with appropriate data for view. A Resource collection may be useful
   */
  public function index()
  {
    return view('campus.campusList', [
      'campuses' => CampusResource::collection(Campus::all()),
      // 'campusesJSON' => CampusResource::collection(Campus::all())->toJson(),
    ]);
  }

  /**
   * Show the form for creating a new campus.
   * 
   * @todo Update with appropriate data for view
   */
  public function create()
  {
    return view('campus.campusForm');
  }

  /**
   * Store a newly created campus in storage.
   * 
   * @todo Update with appropriate view/redirection.
   */
  public function store(StoreCampusRequest $request)
  {
    $validated = $request->safe();
    $address = AddressWrapper::build ([
      'country' => $validated['Country'],
      'state' => $validated['State'],
      'city' => $validated['City'],
      'postalCode' => $validated['Zip'],
      'streetAddress' => $validated['Street'],
    ]);
    $campus = Campus::firstOrNew(['name' => $validated['name']]);
    $campus->address_id = $address->id;
    $campus->save();

    return view('campus.campusForm', [
      'campus' => $campus->load('address', 'buildings')->toArray(),
      'campusJSON' => $campus->load('address', 'buildings')->toJson(),
    ]);
  }

  /**
   * Display the specified campus.
   * 
   * @todo Update with appropriate data. A Resource file may be useful.
   */
  public function show(Campus $campus)
  {
<<<<<<< HEAD
    $campus->load('address');
    return view('campus.campusSingle', [
      'campus' => $campus->toArray(),
      // 'campusJSON' => $campus->toJson(),
=======
    return view('campus.campusForm', [
      'campus' => $campus->load('address', 'buildings')->toArray(),
      'campusJSON' => $campus->load('address', 'buildings')->toJson(),
>>>>>>> c96f0ce205b68e8d7a2dcae0b0e15a8ac41e7f75
    ]);
  }

  /**
   * Show the form for editing the specified campus.
   * 
   * @todo Update view with appropriate data
   */
  public function edit(Campus $campus)
  {
    return view('campus.campusForm', [
      'campus' => $campus->load('address', 'buildings')->toArray(),
      'campusJSON' => $campus->load('address', 'buildings')->toJson(),
    ]);
  }

  /**
   * Update the specified campus in storage.
   * 
   * @todo test w/ CSRF enabled
   * @todo Update with appropriate redirect/view
   */
  public function update(UpdateCampusRequest $request, Campus $campus)
  {
    $data = $request->safe();
    $mapped = array();
    if (isset ($data['name'])) 
    {
      $campus->name = $data['name'];
    }

    if (isset ($data['Country']))
    {
      $mapped['country'] = $data['Country'];
    }

    if (isset ($data['State']))
    {
      $mapped['state'] = $data['State'];
    }

    if (isset ($data['City']))
    {
      $mapped['city'] = $data['City'];
    }

    if (isset ($data['Street']))
    {
      $mapped['streetAddress'] = $data['Street'];
    }

    if (isset ($data['Zip']))
    {
      $mapped['postalCode'] = $data['Zip'];
    }

    AddressWrapper::merge ($mapped, $campus->address()->getRelated()->first());

    $campus->save();

    return view('campus.campusForm', [
      'campus' => $campus->load('address', 'buildings')->toArray(),
      'campusJSON' => $campus->load('address', 'buildings')->toJson(),
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
