<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Key;
use Illuminate\Support\Carbon;

class HolderController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = request()->user();

        $keyAuthorizations = $user->authorizations;

        if ($keyAuthorizations->isEmpty()) {
            return view('holder.holderDash')->with('error', 'No keys found for this user.');
        }

        $uniqueKeys = [];

        foreach ($keyAuthorizations as $keyAuthorization) {
            $keys = $keyAuthorization->issuedKeys()->get();
            foreach ($keys as $key) {
                $uniqueKeys[$key->id] = $key;
            }
        }

        $counts['keys'] = count($uniqueKeys);
        
				$today = Carbon::today();

				$counts['upcoming'] = $keyAuthorizations->filter(function ($key) use ($today) {
					$dueDate = Carbon::parse($key->due_date);
					return $dueDate->isAfter($today);
			})->count();
			

        $counts['dueSoon'] = $keyAuthorizations->filter(function ($key) use ($today) {
            $dueDate = Carbon::parse($key->due_date);
            return $dueDate->diffInDays($today, false) <= 7 && $dueDate->isAfter($today);
        })->count();

        $counts['overdue'] = $keyAuthorizations->filter(function ($key) use ($today) {
            $dueDate = Carbon::parse($key->due_date);
            return $dueDate->isPast() && !$dueDate->isToday();
        })->count();

        $keysData = [];

        foreach ($keyAuthorizations as $keyAuthorization) {
            $keys = $keyAuthorization->issuedKeys()->get();
            foreach ($keys as $key) {
                $dueDate = Carbon::parse($key->pivot->due_date)->format('Y-m-d') ?? 'N/A';
                $statusName = $key->status->name ?? 'N/A';

                array_push($keysData, [
                    $key->id,
                    $dueDate,
                    $statusName
                ]);
            }
        }

        return view('holder.holderDash', ['keysData' => $keysData, 'users' => $user, 'counts' => $counts]);
    }
}
