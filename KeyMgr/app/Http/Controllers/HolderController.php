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
    $keysData = [];

    foreach ($keyAuthorizations as $keyAuthorization) {
      $keys = $keyAuthorization->issuedKeys()->get();
      foreach ($keys as $key) {
        $uniqueKeys[$key->id] = $key;
        
        $counts['keys']++;
        $dueDate = Carbon::parse($key->pivot->due_date);
        if (abs($dueDate->diffInDays($today, false)) <= 7 && $dueDate->isAfter($today)) {
          $counts['dueSoon']++;
        } else if (abs($dueDate->diffInDays($today, false)) <= 30 && $dueDate->isAfter($today)) {
          $counts['upcoming']++;
        } else if ($dueDate->isPast() && !($dueDate->isToday())) {
          $counts['overdue']++;
        }



        $dueDate = Carbon::parse($key->pivot->due_date)->format('Y-m-d') ?? 'N/A';
        $statusName = $key->status->name ?? 'N/A';

        $status = $colorClass = ''; 

        // this should be moved to config/constants.php
        $daysTillDue = Carbon::parse($key->pivot->due_date)->diffInDays($today, false) * -1;

        if ($daysTillDue < 0) {
          $status = "Overdue";
          $colorClass="text-danger";
        }
        elseif ($daysTillDue == 0) {
          $status = "Due Today";
          $colorClass = "text-warning";
        }
        elseif ($daysTillDue <= 7) {
          $status = "Due Soon";
          $colorClass = "text-warning";
        }
        elseif ($daysTillDue <= 30) {
          $status = "Upcoming";
          $colorClass = "text-success";
        }
        else {
          $status = "Future";
          $colorClass = "text-success";
        }

        array_push($keysData, [
          $key->id,
          $dueDate,
          $statusName,
          '<span class="' . $colorClass . '">' . $status . '</span>',
        ]);
      }
    }

    return view('holder.holderDash', ['keysData' => $keysData, 'users' => $user, 'counts' => $counts]);
  }
}
