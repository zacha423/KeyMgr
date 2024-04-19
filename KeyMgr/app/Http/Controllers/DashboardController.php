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

        $counts1['unassigned'] = \App\Models\Key::keyStatus('unassigned')->count();
        $counts1['assigned'] = \App\Models\Key::keyStatus('assigned')->count();
        $counts1['lost'] = \App\Models\Key::keyStatus('lost')->count();
        $counts1['broken'] = \App\Models\Key::keyStatus('broken')->count();
        $counts1['requested'] = \App\Models\Key::keyStatus('requested')->count();


        $pieData = [
            'labels' => [
                'Unassigned',
                'Assigned',
                'Lost',
                'Broken',
                'Requested',
            ],
            'datasets' => [
                [
                    'data' => [$counts1['unassigned'], $counts1['assigned'], $counts1['lost'], $counts1['broken'], $counts1['requested']],
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
