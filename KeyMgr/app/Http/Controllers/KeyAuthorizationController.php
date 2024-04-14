<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\KeyBulkAssignmentRequest;
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
  public function index (Request $request) {
    $auths = [];

    foreach (KeyAuthorization::all() as $auth)
    {
      $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete" data-auth-id="' . $auth->id . '"><i class="fa fa-lg fa-fw fa-trash"></i></button>';
      $btnDetails = '<a href="' . route('authorizations.show', $auth->id)
        . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
            <i class="fa fa-lg fa-fw fa-eye"></i>
            </button>';
      $btnEdit = '<a href="' . route('authorizations.edit', $auth->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
            <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>';
            
      array_push($auths, [
        $auth->id,
        $auth->keyHolder()->first()->getFullname(),
        $auth->keyRequestor()->first()->getFullname(),
        $auth->created_at,
        $auth->issuedKeys()->count(),
        '<nobr>'. $btnEdit . $btnDelete . $btnDetails . '<nobr>',
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
    ]);
  }
}
