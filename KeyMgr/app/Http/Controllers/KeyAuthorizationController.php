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
    return view('authorizations.auths');
  }
}
