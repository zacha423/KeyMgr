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
use App\Http\Resources\BuildingResource;
use App\Models\Building;
use App\Models\Wrappers\BuildingWrapper;

class CampusController extends Controller
{
  /**
   * Display a listing of the campuses.
   * 
   * @todo Update with appropriate data for view. A Resource collection may be useful
   */
  public function index(Request $request)
  {
      // Fetch all campuses with related data
      $campuses = Campus::with(AddressWrapper::loadRelationships(), 'buildings')->get();
  
      // Prepare data for datatable
      $data = [];
  
      foreach ($campuses as $campus) {
        $campusRes = (new CampusResource($campus))->toArray($request);
          // Buttons for edit, delete, and details

          $btnEdit = '<a href="' . route('campus.edit', $campus->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
              <i class="fa fa-lg fa-fw fa-pen"></i>
              </a>';
          $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete" data-campus-id="'
            . $campus->id . '">
            <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>';
          $btnDetails = '<a href="' . route('campus.show', $campus->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                  <i class="fa fa-lg fa-fw fa-eye"></i>
                  </a>';
  
          // Push campus data into $data array
          $data[] = [
              $campus->id,
              $campus->name,
              $campusRes['country'],
              $campusRes['state'],
              $campusRes['city'],
              $campusRes['postalCode'],
              $campusRes['streetAddress'],
              // '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'
          ];
      }
  
      // Pass the formatted data to the view
      return view('campus.campusList', [
          'campuses' => $data,
      ]);
  }
  
  /**
   * Show the form for creating a new campus.
   * 
   * @todo Update with appropriate data for view
   */
  public function create()
  {
    return view('campus.campusList', [
      'campuses' => CampusResource::collection(Campus::with(AddressWrapper::loadRelationships(), 'buildings')->get())->toArray(new Request()),
    ]);
  }

  /**
   * Store a newly created campus in storage.
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

    return redirect('/campus');
  }

  /**
   * Display the specified campus.
   * 
   */
  public function show(Request $request, Campus $campus)
  {
    $buildings = $campus->buildings()->get();
    $buildingTableData = [];
    foreach ($buildings as $buidling)
    {
      $d = new BuildingResource ($buidling);
      array_push($buildingTableData, [$d['id'], $d['name'], '<a href="' . route('building.show', $d['id']) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
            <i class="fa fa-lg fa-fw fa-eye"></i>
            </a>']);
    }

    return view('campus.campusSingle', [
      'campus' => (
        new CampusResource($campus->load(AddressWrapper::loadRelationships(), 'buildings'))
      )->toArray($request),
      'buildings' => $buildingTableData,
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

    return redirect('/campus');
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

