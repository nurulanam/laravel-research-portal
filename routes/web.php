<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\dashboardController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\ChangePasswordController;
use App\Http\Controllers\backend\ProjectController;
use App\Http\Controllers\backend\ProjectApplyController;

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

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/avatar', [ProfileController::class, 'userAvatar'])->name('profile.avatar');
        Route::get('/edit/contact', [ProfileController::class, 'editContact'])->name('profile.edit.contact');
        Route::post('/contact-details', [ProfileController::class, 'contactDetails'])->name('profile.contact.details');
        Route::get('/edit/demographics', [ProfileController::class, 'editDemographics'])->name('profile.edit.demographics');
        Route::post('/demographics', [ProfileController::class, 'demographics'])->name('profile.demographics');
        Route::get('/edit/employment', [ProfileController::class, 'editEmployment'])->name('profile.edit.employment');
        Route::post('/employment', [ProfileController::class, 'employment'])->name('profile.employment');
        Route::get('/edit/skill', [ProfileController::class, 'editSkill'])->name('profile.edit.skill');
        Route::post('/store/skill', [ProfileController::class, 'storeSkill'])->name('profile.store.skill');
    });

    Route::middleware('role:researcher')->group(function (){
        // Project
        Route::resource('/project', ProjectController::class);
    });

    Route::get('/project-apply/{slug}', [ProjectApplyController::class, 'projectScreener'])->name('project.screener');
    Route::resource('/project-apply/', ProjectApplyController::class);
    Route::post('/project-apply/{slug}', [ProjectApplyController::class, 'store'])->name('project-apply.store');

    // Reset Password
    Route::resource('/change-password', ChangePasswordController::class);
});
require __DIR__.'/auth.php';
