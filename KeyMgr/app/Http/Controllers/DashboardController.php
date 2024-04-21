<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Key;

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

        if (Auth::user()->isElevated()) {
            $counts['keys'] = Key::count();
            $counts['doors'] = \App\Models\Door::count();
            $counts['key_requests'] = \App\Models\KeyAuthorization::count();
            $counts['users'] = \App\Models\User::count();
        
            $counts1['unassigned'] = Key::keyStatus(config('constants.keys.statuses.unassigned.name'))->count();
            $counts1['assigned'] = Key::keyStatus(config('constants.keys.statuses.assigned.name'))->count();
            $counts1['lost'] = Key::keyStatus(config('constants.keys.statuses.lost.name'))->count();
            $counts1['broken'] = Key::keyStatus(config('constants.keys.statuses.broken.name'))->count();
            $counts1['requested'] = Key::keyStatus(config('constants.keys.statuses.requested.name'))->count();
        
            $pieData = [
                'labels' => ['Unassigned', 'Assigned', 'Lost', 'Broken', 'Requested'],
                'datasets' => [
                    [
                        'data' => [$counts1['unassigned'], $counts1['assigned'], $counts1['lost'], $counts1['broken'], $counts1['requested']],
                        'backgroundColor' => ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
                    ]
                ]
            ];
        
            $keyAuthorizations = \App\Models\KeyAuthorization::with(['keyHolder', 'keyRequestor', 'rooms'])
                ->orderBy('created_at', 'desc')
                ->take(15)
                ->get()
                ->map(function ($authorization) {
                    return [
                        'id' => $authorization->id,
                        'date' => $authorization->created_at->format('D M d, Y h:iA'),
                        'admin' => $authorization->keyRequestor()->first()->getFullname(),
                        'key' => $authorization->issuedKeys()->first()->getSerial() ?? 'N/A',
                        'user' => $authorization->keyHolder()->first()->getFullname(),
                        'location' => $authorization->issuedKeys()->first()->building()->name ?? 'N/A'
                    ];
                });
    
        
            return view('dashboard', [
                'counts' => $counts,
                'pieData' => $pieData,
                'keyAuthorizations' => $keyAuthorizations,
            ]);
    
        } else {
            return redirect('profile');
        }

    }
    
}
