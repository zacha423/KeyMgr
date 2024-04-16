<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\KeyAuthorizationFilterRequest;
use App\Http\Requests\KeyBulkAssignmentRequest;
use App\Models\Building;
use App\Models\IssuedKey;
use App\Models\KeyAuthorization;
use App\Models\KeyAuthStatus;
use App\Models\Key;
use App\Models\KeyStatus;
use App\Models\User;
use Illuminate\Http\Request;

class KeyAuthorizationController extends Controller
{
  /**
   * Assign multiple keys to a user with a generic agreement.
   */
  public function bulkAssign (KeyBulkAssignmentRequest $request)
  {
    $validated = $request->safe();

    $keyAuthAgreement = new KeyAuthorization();
    $keyAuthAgreement->key_holder_user_id = $validated['user'];
    $keyAuthAgreement->requestor_user_id = $request->user()->id;
    $keyAuthAgreement->key_auth_status_id = KeyAuthStatus::where([
      'name' => config('constants.keyauthreq.statuses.new.name')
    ])->first()->id;
    $keyAuthAgreement->save();

    foreach ($validated['selectedKeys'] as $key) {
      $issuedKey = new IssuedKey ();
      $issuedKey->key_authorization_id = $keyAuthAgreement->id;
      $issuedKey->key_id = $key;
      $issuedKey->save();
      Key::find($key)->first()->key_status_id = KeyStatus::where([
        'name' => config('constants.keys.statuses.requested.name')
      ])->first()->id;
    }

    return redirect()->route('keys.index');
  }

  /**
   * Display a listing of the resource.
   */
  public function index (KeyAuthorizationFilterRequest $request) {

    $validated = $request->safe();
    $keyAuthorizations = KeyAuthorization::with('issuedKeys', 'keyHolder', 'keyRequestor', 'rooms', 'rooms.building');
    
    if (isset($validated['holderSel'])) {
      $keyAuthorizations->whereIn('key_holder_user_id', $validated['holderSel']);
    }

    if (isset($validated['requestorSel'])) {
      $keyAuthorizations->whereIn('requestor_user_id', $validated['requestorSel']);
    }

    if (isset($validated['range'])) {
      $dates = explode(' - ', $validated['range']);
      $keyAuthorizations->where('updated_at', '>', $dates[0])->where('updated_at', '<', $dates[1]);
    }

    if (isset($validated['count'])) {
      $keyAuthorizations->whereHas('issuedKeys', function ($query) {}, '>=', $validated['count']);
    }

    if (isset($validated['roomSel']))
    {
      $keyAuthorizations->whereHas('rooms', function ($query) use ($validated) {
        $query->whereIn('rooms.id', $validated['roomSel']);
      });
    }
    else if (isset($validated['buildingSel']))
    {
      $keyAuthorizations->whereHas('rooms.building', function ($query) use ($validated) {
        $query->where(['buildings.id' => $validated['buildingSel']]);
      });
    }

    $auths = [];

    foreach ($keyAuthorizations->get() as $auth)
    {
      $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete" data-auth-id="1"><i class="fa fa-lg fa-fw fa-trash"></i></button>';
      $btnDetails = '<a href="' . route('authorizations.show', $auth->id)
        . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
            <i class="fa fa-lg fa-fw fa-eye"></i>';
      $btnEdit = '<a href="' . route('authorizations.edit', $auth->id) 
        . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
            <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>';

      array_push($auths, [
        $auth->id,
        $auth->keyHolder()->first()->getFullname(),
        $auth->keyRequestor()->first()->getFullname(),
        $auth->created_at->format('m-d-Y'),
        $auth->issuedKeys()->count(),
        '<nobr>'. $btnEdit . $btnDelete . $btnDetails . '</nobr>',
      ]);
    }

    $allAuths = KeyAuthorization::all();
    $holderIDs = $allAuths->pluck('key_holder_user_id')->toArray();
    $requestorIDs = $allAuths->pluck('requestor_user_id')->toArray();
    $holders = [];
    $requestors = [];
    foreach (User::whereIn('id', $holderIDs)->get() as $user) {
      $holders[$user->id] = $user->getFullname();
    }
    foreach (User::whereIn('id', $requestorIDs)->get() as $user) {
      $requestors[$user->id] = $user->getFullname();
    }

    return view('authorizations.auths', [
      'auths' => $auths,
      'holders' => $holders,
      'requestors' => $requestors,
      'buildings' => Building::all()->pluck('name' , 'id')->toArray(),
    ]);
  }

  /**
   * Store a newly created Key Authorization in storage.
   */
  public function store (Request $request){}

  /**
   * Display the specified key authorization.
   */
  public function show (KeyAuthorization $keyAuthorization){}

  /**
   * Show the form editing the specified resource
   */
  public function edit (KeyAuthorization $keyAuthorization){}

  /**
   * Update the specified resource in storage.
   */
  public function update (Request $request, KeyAuthorization $keyAuthorization){}

  /**
   * Remove the specified Key Authorization from storage.
   * 
   * @todo - DOesn't seem to work, but at least it creates a popup window.
   */
  public function destroy (KeyAuthorization $keyAuthorization) {
    $keyAuthorization->delete();
    return redirect()->route('authorizations.index');
  }
}
