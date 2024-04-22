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

    foreach ($keyAuthorizations as $keyAuthorization) {
        $keys = $keyAuthorization->issuedKeys()->get();
				foreach ($keys as $key) {
					array_push($keysData, [
						$key->id,
						$key->pivot->due_date	?? 'N/A',
            $key->status->name ?? 'N/A'
					]);
            
        }
    }

    return view('holder.holderDash', ['keysData' => $keysData, 'users' => $user]);
	}

}