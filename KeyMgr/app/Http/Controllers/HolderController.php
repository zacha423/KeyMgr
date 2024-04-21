<?php

namespace App\Http\Controllers;

class HolderController extends Controller
{
	public function dashboard() {
  
    $user = auth()->user();

    $keyAuthorizations = $user->authorizations;

    if ($keyAuthorizations->isEmpty()) {
        return view('holder.holderDash')->with('error', 'No keys found for this user.');
    }

    $keysData = [];
		$keysDue = [];

    foreach ($keyAuthorizations as $keyAuthorization) {
        $keys = $keyAuthorization->issuedKeys()->get();
				foreach ($keys as $key) {
					array_push($keysData, [
						$key->id,
            $key->status->name ?? 'N/A'
					]);

					array_push($keysDue, [
						$key->id,
						$key->due_date	?? 'N/A'
					]);
            
        }
    }

    return view('holder.holderDash', ['keysData' => $keysData, 'users' => $user, 'keyDates' => $keysDue]);
	}

}