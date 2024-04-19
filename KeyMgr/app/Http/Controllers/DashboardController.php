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
        // if (Auth::user()->isElevated()) {
            
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
        $counts['key_requests'] = \App\Models\KeyAuthorization::count();
        $counts['users'] = \App\Models\User::count();


        $pieData = [
            'labels' => [
                'Checked out',
                'Assigned',
                'Lost',
                'In Inventory',
                'Other',
            ],
            'datasets' => [
                [
                    'data' => [700, 500, 400, 600, 300],
                    'backgroundColor' => ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
                ]
            ]
        ];

        return view('dashboard', [
            'counts' => $counts,
            'pieData' => $pieData,
        ]);
    }

}
