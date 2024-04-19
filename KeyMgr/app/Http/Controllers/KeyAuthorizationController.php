<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\KeyAuthorizationFilterRequest;
use App\Http\Requests\KeyAuthorizationRequest;
use App\Http\Requests\KeyBulkAssignmentRequest;
use App\Models\Building;
use App\Models\IssuedKey;
use App\Models\KeyAuthorization;
use App\Models\KeyAuthStatus;
use App\Models\Key;
use App\Models\KeyStatus;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class KeyAuthorizationController extends Controller
{
  /**
   * Assign multiple keys to a user with a generic agreement.
   */
  public function bulkAssign(KeyBulkAssignmentRequest $request)
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
      $issuedKey = new IssuedKey();
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
  public function index(KeyAuthorizationFilterRequest $request)
  {

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

    if (isset($validated['roomSel'])) {
      $keyAuthorizations->whereHas('rooms', function ($query) use ($validated) {
        $query->whereIn('rooms.id', $validated['roomSel']);
      });
    } else if (isset($validated['buildingSel'])) {
      $keyAuthorizations->whereHas('rooms.building', function ($query) use ($validated) {
        $query->where(['buildings.id' => $validated['buildingSel']]);
      });
    }

    $auths = [];

    foreach ($keyAuthorizations->get() as $auth) {
      $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete" data-auth-id="' 
        . $auth->id . '"><i class="fa fa-lg fa-fw fa-trash"></i></button>';
      $btnDetails = '<a href="' . route('authorizations.show', $auth->id)
        . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
            <i class="fa fa-lg fa-fw fa-eye"></i>';
      $btnEdit = '<a href="' . route('authorizations.edit', $auth->id)
        . '" class="btn btn-xs btn-default text-primary mx-1 shadow disabled" title="Edit">
            <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>';

      array_push($auths, [
        $auth->id,
        $auth->keyHolder()->first()->getFullname(),
        $auth->keyRequestor()->first()->getFullname(),
        $auth->created_at->format('m-d-Y'),
        // Since the key might not be immediately available - have to assume off requested rooms.
        $auth->rooms()->count(),
        '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>',
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

    $allHolders = [];
    $allRequestors = [];

    foreach (User::whereHas('roles', function ($query) {
      $query->where(['name' => config('constants.roles.holder')]);
    })->get() as $holder) {
      $allHolders[$holder->id] = $holder->getFullname();
    }

    foreach (User::whereHas('roles', function ($query) {
      $query->where(['name' => config('constants.roles.requestor')]);
    })->get() as $requestor) {
      $allRequestors[$requestor->id] = $requestor->getFullName();
    }

    return view('authorizations.auths', [
      'auths' => $auths,
      'holders' => $holders,
      'requestors' => $requestors,
      'allHolders' => $allHolders,
      'allRequestors' => $allRequestors,
      'buildings' => Building::all()->pluck('name', 'id')->toArray(),
    ]);
  }

  /**
   * Store a newly created Key Authorization in storage.
   */
  public function store(KeyAuthorizationRequest $request)
  {
    $validated = $request->safe();

    $agreement = new KeyAuthorization;
    $agreement->key_holder_user_id = $validated['holderSel_create'];
    $agreement->requestor_user_id = $validated['requestorSel_create'];
    $agreement->key_auth_status_id = KeyAuthStatus::where([
      'name' => config('constants.keyauthreq.statuses.new.name'),
    ])->first()->id;

    $agreement->save();

    $room = Room::find($validated['roomSel'][0]);
    $key = $room->availableKeys_query()->first();

    // Key might not be immediately available
    if ($key !== null) {
      $agreement->issuedKeys()->save($key);
    }

    $agreement->rooms()->save($room);

    return redirect()->route('authorizations.index');
  }

  /**
   * Display the specified key authorization.
   */
  public function show(KeyAuthorization $authorization)
  {
    $authorization->load('keyHolder','keyRequestor','rooms','issuedKeys', 'rooms.building');
    $keyHolder = $authorization->keyHolder()->first();
    $keyRequestor = $authorization->keyRequestor()->first();
    $holder = [];
    $requestor = [];

    $holder['email'] = $keyHolder->email;
    $holder['name'] = $keyHolder->getFullname();
    $requestor['email'] = $keyRequestor->email;
    $requestor['name'] = $keyRequestor->getFullname();

    $keys = 0;
    $keys_withstanding = 0;

    foreach ($keyHolder->authorizations()->get() as $agree) {
      $keys += $agree->issuedKeys()->wherePivot('due_date', '>', date('Y-m-d'))->count();
      $keys_withstanding = $agree->issuedKeys()->wherePivot('due_date', '<', date('Y-m-d'))->whereHas('status', function ($query) {
        $query->where(['name' => 'Assigned']);
      })->count();
    }

    $holder['keys'] = $keys;
    $holder['withstanding'] = $keys_withstanding;
    $holder['agreements'] = $keyHolder->authorizations()->count();
    $keys = 0;
    $keys_withstanding = 0;

    foreach ($keyRequestor->authorizations()->get() as $agree) {
      $keys += $agree->issuedKeys()->wherePivot('due_date', '>', date('Y-m-d'))->count();
      $keys_withstanding = $agree->issuedKeys()->wherePivot('due_date', '<', date('Y-m-d'))->whereHas('status', function ($query) {
        $query->where(['name' => 'Assigned']);
      })->count();
    }

    $requestor['keys'] = $keys;
    $requestor['agreements'] = $keyRequestor->authorizations()->count();
    $requestor['withstanding'] = $keys_withstanding;


    $key = [];
    $firstKey = $authorization->issuedKeys()->first();
    $key['serial'] = $firstKey->getSerial();
    $key['room'] = $firstKey->room()->number;
    $key['building'] = $firstKey->building()->name;

    return view('authorizations.authSingle', [
      'auth' => $authorization, 'k' => $keys,
      'holder' => $holder,
      'requestor' => $requestor,
      'key' => $key,
    ]);
  }

  /**
   * Show the form editing the specified resource
   */
  public function edit(KeyAuthorization $authorization)
  {
    // $keyHolder = $authorization->keyHolder()->get();

    return redirect()->route('authorizations.index');
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(KeyAuthorizationRequest $request, KeyAuthorization $authorization)
  {
    return redirect()->route('authorizations.index');
  }

  /**
   * Remove the specified Key Authorization from storage.
   * 
   * @todo - DOesn't seem to work, but at least it creates a popup window.
   */
  public function destroy(KeyAuthorization $authorization)
  {
    $authorization->delete();
    return redirect()->route('authorizations.index');
  }
}
