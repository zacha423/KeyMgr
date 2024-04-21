<?php

use App\Http\Controllers\BuildingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeyAuthorizationController;
use App\Http\Controllers\LockController;
use App\Http\Controllers\KeyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CampusController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resources ([
  'groups' => UserGroupController::class,
  'roles' => UserRoleController::class,
  'users' => UserController::class,
]);

// Route::get('/', function () {
//   return redirect('/login');
// });

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->get(
  '/',
  [DashboardController::class, 'index']
)->name('dashboard');

Route::get('/index', function () {
  return view('index');
})->middleware(['auth', 'verified'])->name('index');

Route::get('/log', function () {
  return view('log');
})->middleware(['auth', 'verified'])->name('log');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  Route::post('/groups/members', [UserController::class, 'groupMembershipManagement'])->name('users.groups');
  Route::post('/roles/members', [UserController::class, 'roleMembershipManagement'])->name('users.roles');
  Route::get('building/{building}/rooms', [BuildingController::class, 'showRooms'])->name('building.buildingRooms');
  Route::post('groups/roles', [UserGroupController::class, 'manageRoles'])->name('groups.roles');
  Route::post('roles/groups', [UserRoleController::class, 'manageGroups'])->name('roles.groups');
  Route::get('rooms', [LockController::class, 'getRooms'])->name('getRooms');
  Route::post('/keyauth/bulk', [KeyAuthorizationController::class, 'bulkAssign'])->name('keys.massassign');
  
  $resourceControllers = [
    'groups' => UserGroupController::class,
    'roles' => UserRoleController::class,
    'users' => UserController::class,
    'locks' => LockController::class,
    'room' => RoomController::class,
    'building' => BuildingController::class,
    'keys' => KeyController::class,
    'authorizations' => KeyAuthorizationController::class,
    'campus' => CampusController::class,
  ];
  foreach ($resourceControllers as $name => $controller) {
    Route::resource($name, $controller)->except(['create']);
  }

});



require __DIR__ . '/auth.php';