<?php
/**
 * @author Maximus Hudson
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
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
    $uniqueKeys = [];
    $today = Carbon::today();
    $counts['keys'] = $counts['upcoming'] = $counts['dueSoon'] = $counts['overdue'] = 0;

    foreach ($keyAuthorizations as $keyAuthorization) {
      $keys = $keyAuthorization->issuedKeys()->get();
      foreach ($keys as $key) {
        $uniqueKeys[$key->id] = $key;
        
        $counts['keys']++;
        $dueDate = Carbon::parse($key->pivot->due_date);
        if (abs($dueDate->diffInDays($today, false)) <= 7 && $dueDate->isAfter($today)) {
          $counts['dueSoon']++;
        } else if (abs($dueDate->diffInDays($today, false)) <= 20 && $dueDate->isAfter($today)) {
          $counts['upcoming']++;
        } else if ($dueDate->isPast() && !($dueDate->isToday())) {
          $counts['overdue']++;
        }


      }
    }

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
