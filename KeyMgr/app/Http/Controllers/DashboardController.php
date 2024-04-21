<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Key;
use App\Models\KeyAuthorization;

class DashboardController extends Controller
{
    /**
     * Check authorization and display admin dashboard, otherwise display
     * the user's checked-out keys (key holder view).
     */
    public function index()
    {
        if (Auth::user()->isElevated()) {
            $counts['keys'] = Key::count();
            $counts['locks'] = \App\Models\Lock::count();
            $counts['key_requests'] = KeyAuthorization::count();
            $counts['users'] = \App\Models\User::count();
        
            $counts1['unassigned'] = Key::keyStatus(config('constants.keys.statuses.unassigned.name'))->count();
            $counts1['assigned'] = Key::keyStatus(config('constants.keys.statuses.assigned.name'))->count();
            $counts1['lost'] = Key::keyStatus(config('constants.keys.statuses.lost.name'))->count();
            $counts1['broken'] = Key::keyStatus(config('constants.keys.statuses.broken.name'))->count();
            $counts1['requested'] = Key::keyStatus(config('constants.keys.statuses.requested.name'))->count();

            $counts2['new'] = KeyAuthorization::authorizationStatus(config('constants.keyauthreq.statuses.new.name'))->count();
            $counts2['noncomply'] = KeyAuthorization::authorizationStatus(config('constants.keyauthreq.statuses.noncomply.name'))->count();
            $counts2['active'] = KeyAuthorization::authorizationStatus(config('constants.keyauthreq.statuses.active.name'))->count();
        
            $pieData1 = [
                'labels' => ['Unassigned', 'Assigned', 'Lost', 'Broken', 'Requested'],
                'datasets' => [
                    [
                        'data' => [$counts1['unassigned'], $counts1['assigned'], $counts1['lost'], $counts1['broken'], $counts1['requested']],
                        'backgroundColor' => ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
                    ]
                ]
            ];

            $pieData2 = [
                'labels' => ['New', 'Non-Complient', 'Active'],
                'datasets' => [
                    [
                        'data' => [$counts2['new'], $counts2['noncomply'], $counts2['active']],
                        'backgroundColor' => ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
                    ]
                ]
            ];
        
            $keyAuthorizations = KeyAuthorization::with(['keyHolder', 'keyRequestor', 'rooms'])
                ->orderBy('created_at', 'desc')
                ->take(10)
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
                'pieData1' => $pieData1,
                'pieData2' => $pieData2,
                'keyAuthorizations' => $keyAuthorizations,
            ]);
    
        } else {
            return redirect('profile');
        }

    }
    
}
