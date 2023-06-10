<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\dashboardController;
use App\Http\Controllers\backend\ProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/dashboard')->middleware(['auth', 'verified', 'role:researcher|participant'])->group(function (){
    Route::get('/', [dashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('/profile', ProfileController::class);
    Route::post('/profile-avatar', [ProfileController::class, 'userAvatar'])->name('profile.avatar');
});
require __DIR__.'/auth.php';
