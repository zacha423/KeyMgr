<?php

use App\Http\Controllers\BuildingController;
use App\Http\Controllers\ProfileController;
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
    'accounts' => UserController::class,
    'campus' => CampusController::class,
  ]);
  Route::resource('room', RoomController::class,)->except(['create']);
  Route::resource('building', BuildingController::class)->except(['create']);
});

require __DIR__ . '/auth.php';
