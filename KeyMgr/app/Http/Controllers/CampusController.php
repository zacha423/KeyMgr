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

use Illuminate\Http\Request;

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
    return view('campus.campusList');
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
      'country' => $validated['country'],
      'state' => $validated['state'],
      'city' => $validated['city'],
      'postalCode' => $validated['postalCode'],
      'streetAddress' => $validated['streetAddress'],
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
    return view('campus.campusSingle', [
      'campus' => (
        new CampusResource($campus->load(AddressWrapper::loadRelationships(), 'buildings'))
      )->toArray(new Request()), //Hacky. This works, but is shitty, and an alternative solution should be found.
      'campusJSON' => $campus->load(AddressWrapper::loadRelationships(), 'buildings')->toJson(),
    ]);
  }

  /**
   * Show the form for editing the specified campus.
   * 
   * @todo Update view with appropriate data
   */
  public function edit(Campus $campus)
  {
    return view('campus.campusEdit', [
      'campus' => (
        new CampusResource($campus->load(AddressWrapper::loadRelationships(), 'buildings'))
      )->toArray(new Request()), //Hacky. This works, but is shitty, and an alternative solution should be found.
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

    if (isset ($data['country']))
    {
      $mapped['country'] = $data['country'];
    }

    if (isset ($data['state']))
    {
      $mapped['state'] = $data['state'];
    }

    if (isset ($data['city']))
    {
      $mapped['city'] = $data['city'];
    }

    if (isset ($data['streetAddress']))
    {
      $mapped['streetAddress'] = $data['streetAddress'];
    }

    if (isset ($data['postalCode']))
    {
      $mapped['postalCode'] = $data['postalCode'];
    }
    
    $campus->save();
    $address = AddressWrapper::merge ($mapped, $campus->address()->getRelated()->first());
    $address->campus()->save($campus);

    return view('campus.campusForm', [
      'campus' => new CampusResource($campus->load('address', 'buildings')->toArray()),
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
