<?php

use App\Http\Controllers\BuildingController;
<<<<<<< HEAD
use App\Http\Controllers\LockController;
=======
use App\Http\Controllers\KeyController;
>>>>>>> main
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
  'locks' => LockController::class,
]);

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

  Route::post('/accounts/groups/assign', [UserController::class, 'assignUsersToGroup'])->name('user.group.assign');
  Route::post('/accounts/groups/unassign', [UserController::class, 'unassignUsersFromGroup'])->name('user.group.unassign');
  Route::resource('room', RoomController::class,)->except(['create']);
  Route::resource('building', BuildingController::class)->except(['create']);
  Route::resource('keys', KeyController::class)->except(['create']);
  Route::get('building/{building}/rooms', [BuildingController::class, 'showRooms'])->name('building.buildingRooms');
});



require __DIR__ . '/auth.php';
