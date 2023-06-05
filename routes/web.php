<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\dashboardController;
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

//Route::get('/verify-test', function (){
//    return view('auth.verify-email');
//});

Route::prefix('/dashboard')->middleware(['auth', 'verified', 'role:researcher|participant'])->group(function (){
    Route::get('/', [dashboardController::class, 'index'])->name('dashboard.index');
});
require __DIR__.'/auth.php';
