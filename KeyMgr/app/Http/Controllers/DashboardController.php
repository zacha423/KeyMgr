<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Check authorization and display admin dashboard, otherwise display
     * the user's checked-out keys (key holder view).
     */
    public function index()
    {
        // if (Auth::user()->hasAccess('admin')) {
            
        //     $counts['keys'] = \App\Models\Key::count();
        //     $counts['doors'] = \App\Models\Door::count();
        //     // Building right now is a place-holder until key requests is finalized
        //     // ----------------------------------------------------
        //     $counts['key_requests'] = \App\Models\Building::count();
        //     // ----------------------------------------------------
        //     $counts['users'] = \App\Models\User::count();




        //     return view('dashboard', [
        //         'counts' => $counts,
        //     ]);
        // } else {
        //     // Profile right now is a place-holder until view is finalized
        //     return redirect('profile');
        // }

        $counts['keys'] = \App\Models\Key::count();
        $counts['doors'] = \App\Models\Door::count();
        // Building right now is a place-holder until key requests is finalized
        // ----------------------------------------------------
        $counts['key_requests'] = \App\Models\Building::count();
        // ----------------------------------------------------
        $counts['users'] = \App\Models\User::count();




        return view('dashboard', [
            'counts' => $counts,
        ]);
    }

}
