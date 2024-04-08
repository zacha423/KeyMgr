<?php

use App\Http\Controllers\BuildingController;
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


Route::get('/', function () {
  return redirect('/login');
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
  Route::resources([
    'campus' => CampusController::class,
  ]);
  Route::resources(['users' => UserController::class,]);
  Route::post('/groups/members', [UserController::class, 'groupMembershipManagement'])->name('users.groups');
  Route::post('/roles/members', [UserController::class, 'roleMembershipManagement'])->name('users.roles');
  Route::resource('room', RoomController::class,)->except(['create']);
  Route::resource('building', BuildingController::class)->except(['create']);
  Route::resource('keys', KeyController::class)->except(['create']);
  Route::resource('groups', UserGroupController::class)->except(['create']);
  Route::resource('roles', UserRoleController::class)->except(['create']);
  Route::get('building/{building}/rooms', [BuildingController::class, 'showRooms'])->name('building.buildingRooms');
  Route::post('groups/roles', [UserGroupController::class, 'manageRoles'])->name('groups.roles');
  Route::post('roles/groups', [UserRoleController::class, 'manageGroups'])->name('roles.groups');
  Route::resource('locks', LockController::class)->except(['create']);
  Route::get('rooms', [LockController::class, 'getRooms'])->name('getRooms');
});



require __DIR__ . '/auth.php';
