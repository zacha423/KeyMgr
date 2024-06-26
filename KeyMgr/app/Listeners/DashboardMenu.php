<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Listeners;

use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Route;

class DashboardMenu
{
  /**
   * Create the event listener.
   */
  public function __construct()
  {
    //
  }

  /**
   * Handle the event.
   */
  public function handle(BuildingMenu $event): void
  {
    // Add button to top nav if route is the key holder dashboard, and the user is admin.
    if (Route::currentRouteName() === 'dashboard' && Auth::user()->isElevated()) {
      $event->menu->add([
        'topnav' => true,
        'text' => 'Switch to Admin',
        'url' => '/admin',
      ], );
    }
    // Add button to top nav if route is the admin dashboard.
    else if (Route::currentRouteName() === 'adminDash') {
      $event->menu->add([
        'topnav' => true,
        'text' => 'Switch to Holder',
        'url' => '/',
      ]);
    }
  }
}
