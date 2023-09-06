<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\ChangePasswordController;
use App\Http\Controllers\backend\ProjectController;
use App\Http\Controllers\backend\ProjectApplyController;
use App\Http\Controllers\backend\ProjectHireController;

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

//Route::middleware(['guest'])->get('/researcher-login', [AuthenticatedSessionController::class, 'researcherLogin'])->name('researcher.login');
//Route::middleware(['guest'])->get('/participant-login', [AuthenticatedSessionController::class, 'participantLogin'])->name('participant.login');

//Dashboard
Route::prefix('/dashboard')->middleware(['auth', 'verified', 'role:researcher|participant'])->group(function (){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/avatar', [ProfileController::class, 'storeUserAvatar'])->name('profile.avatar');
        Route::get('/edit/contact', [ProfileController::class, 'editContact'])->name('profile.edit.contact');
        Route::post('/contact-details', [ProfileController::class, 'storeContactDetails'])->name('profile.contact.details');
        Route::get('/edit/demographics', [ProfileController::class, 'editDemographics'])->name('profile.edit.demographics');
        Route::post('/demographics', [ProfileController::class, 'storeDemographics'])->name('profile.demographics');
        Route::get('/edit/employment', [ProfileController::class, 'editEmployment'])->name('profile.edit.employment');
        Route::post('/employment', [ProfileController::class, 'storeEmployment'])->name('profile.employment');
        Route::get('/edit/skill', [ProfileController::class, 'editSkill'])->name('profile.edit.skill');
        Route::post('/skill', [ProfileController::class, 'storeSkill'])->name('profile.store.skill');
    });


    Route::middleware('role:researcher|participant')->group(function (){
        // Project
        Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
    });
    Route::middleware('role:participant')->group(function (){
        // Project
        Route::put('/project/response/withdraw/{id}', [ProjectController::class, 'withdrawResponse'])->name('project.withdraw.response');
    });
    Route::middleware('role:researcher')->group(function (){
        // Project
        Route::resource('/project', ProjectController::class)->except('index', 'withdrawResponse');
        Route::get('/project/edit/{slug}', [ProjectController::class, 'edit'])->name('project.preview')->name('project.edit');
        Route::get('/project/preview/{slug}', [ProjectController::class, 'projectPreview'])->name('project.preview');
        Route::get('/project/{slug}/participants', [ProjectController::class, 'projectParticipants'])->name('project.participants');
        Route::get('/project/{slug}/response/{id}', [ProjectController::class, 'showParticipantResponse'])->name('project.participant.response');
        Route::delete('/project/{slug}', [ProjectController::class, 'destroy'])->name('project.delete');
        Route::get('/project-hire/{slug}/{id}', [ProjectHireController::class, 'projectHire'])->name('project.hire');
    });
    Route::middleware('role:participant')->group(function () {
        Route::resource('/project-apply/', ProjectApplyController::class);
        Route::get('/project-apply/{slug}', [ProjectApplyController::class, 'projectScreener'])->name('project.screener');
        Route::post('/project-apply/{slug}', [ProjectApplyController::class, 'store'])->name('project-apply.store');
    });
    // Reset Password
    Route::resource('/change-password', ChangePasswordController::class);
});
require __DIR__.'/auth.php';
