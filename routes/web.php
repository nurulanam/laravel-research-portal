<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\dashboardController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\SkillController;
use App\Http\Controllers\backend\ChangePasswordController;
use App\Http\Controllers\backend\ProjectController;

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

//Dashboard
Route::prefix('/dashboard')->middleware(['auth', 'verified', 'role:researcher|participant'])->group(function (){
    Route::get('/', [dashboardController::class, 'index'])->name('dashboard.index');

    //Profile
    Route::resource('/profile', ProfileController::class);
    Route::post('/profile-avatar', [ProfileController::class, 'userAvatar'])->name('profile.avatar');
    Route::post('/profile-contact-details', [ProfileController::class, 'contactDetails'])->name('profile.contact.details');
    Route::post('/profile-demographics', [ProfileController::class, 'demographics'])->name('profile.demographics');
    Route::post('/profile-employment', [ProfileController::class, 'employment'])->name('profile.employment');

    //Skills

    Route::resource('/skills', SkillController::class);
    Route::post('/skills/list', [SkillController::class, 'skillsApi'])->name('skills.api');

    Route::middleware('role:researcher')->group(function (){
        // Project
        Route::resource('/project', ProjectController::class);
    });


    // Reset Password
    Route::resource('/change-password', ChangePasswordController::class);
});
require __DIR__.'/auth.php';
