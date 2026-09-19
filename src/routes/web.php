<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\MatchSetupController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ScoringController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/


Route::get('/', [LandingController::class, 'index'])
    ->name('landing.home');

Route::get('/about', [LandingController::class, 'about'])
    ->name('landing.about');

Route::get('/schedule', [LandingController::class, 'schedule'])
    ->name('landing.schedule');

Route::get('/brackets', [LandingController::class, 'brackets'])
    ->name('landing.brackets');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('proses');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'permission:dashboard.view'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

});


/*
|--------------------------------------------------------------------------
| Participants
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // View participants
    Route::get('/dashboard/partisipan', [ParticipantController::class, 'index'])
        ->middleware('permission:participant.view')
        ->name('partisipan.index');

    // Create participant form
    Route::get('/dashboard/partisipan/create', [ParticipantController::class, 'create'])
        ->middleware('permission:participant.create')
        ->name('partisipan.create');

    // Store participant
    Route::post('/dashboard/partisipan', [ParticipantController::class, 'store'])
        ->middleware('permission:participant.create')
        ->name('partisipan.store');

    // Show participant
    Route::get('/dashboard/partisipan/{participant}', [ParticipantController::class, 'show'])
        ->middleware('permission:participant.view')
        ->name('partisipan.show');

    // Edit participant form
    Route::get('/dashboard/partisipan/{participant}/edit', [ParticipantController::class, 'edit'])
        ->middleware('permission:participant.update')
        ->name('partisipan.edit');

    // Update participant
    Route::put('/dashboard/partisipan/{participant}', [ParticipantController::class, 'update'])
        ->middleware('permission:participant.update')
        ->name('partisipan.update');

    // Delete participant
    Route::delete('/dashboard/partisipan/{participant}', [ParticipantController::class, 'destroy'])
        ->middleware('permission:participant.delete')
        ->name('partisipan.destroy');

});


/*
|--------------------------------------------------------------------------
| Competition
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard/competition', [CompetitionController::class, 'index'])
        ->middleware('permission:competition.view')
        ->name('competition.index');

    Route::get('/dashboard/competition/create', [CompetitionController::class, 'create'])
        ->middleware('permission:competition.create')
        ->name('competition.create');

    Route::post('/dashboard/competition', [CompetitionController::class, 'store'])
        ->middleware('permission:competition.create')
        ->name('competition.store');

    Route::get('/dashboard/competition/{competition}', [CompetitionController::class, 'show'])
        ->middleware('permission:competition.view')
        ->name('competition.show');

    Route::get('/dashboard/competition/{competition}/edit', [CompetitionController::class, 'edit'])
        ->middleware('permission:competition.update')
        ->name('competition.edit');

    Route::put('/dashboard/competition/{competition}', [CompetitionController::class, 'update'])
        ->middleware('permission:competition.update')
        ->name('competition.update');

    Route::delete('/dashboard/competition/{competition}', [CompetitionController::class, 'destroy'])
        ->middleware('permission:competition.delete')
        ->name('competition.destroy');

});


/*
|--------------------------------------------------------------------------
| Category
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard/category', [CategoryController::class, 'index'])
        ->middleware('permission:category.view')
        ->name('category.index');

    Route::get('/dashboard/category/create', [CategoryController::class, 'create'])
        ->middleware('permission:category.create')
        ->name('category.create');

    Route::post('/dashboard/category', [CategoryController::class, 'store'])
        ->middleware('permission:category.create')
        ->name('category.store');

    Route::get('/dashboard/category/{category}', [CategoryController::class, 'show'])
        ->middleware('permission:category.view')
        ->name('category.show');

    Route::get('/dashboard/category/{category}/edit', [CategoryController::class, 'edit'])
        ->middleware('permission:category.update')
        ->name('category.edit');

    Route::put('/dashboard/category/{category}', [CategoryController::class, 'update'])
        ->middleware('permission:category.update')
        ->name('category.update');

    Route::delete('/dashboard/category/{category}', [CategoryController::class, 'destroy'])
        ->middleware('permission:category.delete')
        ->name('category.destroy');

});


/*
|--------------------------------------------------------------------------
| Match
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard/match', [MatchController::class, 'index'])
        ->middleware('permission:match.view')
        ->name('match.index');

    Route::get('/dashboard/match/create', [MatchController::class, 'create'])
        ->middleware('permission:match.create')
        ->name('match.create');

    Route::post('/dashboard/match', [MatchController::class, 'store'])
        ->middleware('permission:match.create')
        ->name('match.store');

    Route::get('/dashboard/match/{match}', [MatchController::class, 'show'])
        ->middleware('permission:match.view')
        ->name('match.show');

    Route::get('/dashboard/match/{match}/edit', [MatchController::class, 'edit'])
        ->middleware('permission:match.update')
        ->name('match.edit');

    Route::put('/dashboard/match/{match}', [MatchController::class, 'update'])
        ->middleware('permission:match.update')
        ->name('match.update');

    Route::delete('/dashboard/match/{match}', [MatchController::class, 'destroy'])
        ->middleware('permission:match.delete')
        ->name('match.destroy');

});


/*
|--------------------------------------------------------------------------
| Match Setup
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Match setup page
    Route::get('/dashboard/match-setup', [MatchSetupController::class, 'index'])
        ->middleware('permission:match.view')
        ->name('match-setup.index');

    // Add participant to match
    Route::post(
        '/dashboard/matches/{match}/participants',
        [MatchSetupController::class, 'storeParticipant']
    )
        ->middleware('permission:match.update')
        ->name('match-setup.participants.store');

    // Update participant in match
    Route::put(
        '/dashboard/matches/{match}/participants/{participant}',
        [MatchSetupController::class, 'updateParticipant']
    )
        ->middleware('permission:match.update')
        ->name('match-setup.participants.update');

    // Remove participant from match
    Route::delete(
        '/dashboard/matches/{match}/participants/{participant}',
        [MatchSetupController::class, 'destroyParticipant']
    )
        ->middleware('permission:match.update')
        ->name('match-setup.participants.destroy');

    // Update match settings
    Route::put(
        '/dashboard/match/{match}/settings',
        [MatchSetupController::class, 'updateSettings']
    )
        ->middleware('permission:match.update')
        ->name('match-setup.settings.update');

});


/*
|--------------------------------------------------------------------------
| Scoring
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Scoring list
    Route::get(
        '/dashboard/scoring',
        [ScoringController::class, 'index']
    )
        ->middleware('permission:scoring.view')
        ->name('scoring.index');

    // Store scores
    Route::post(
        '/dashboard/matches/{match}/scores',
        [ScoringController::class, 'store']
    )
        ->middleware('permission:scoring.create')
        ->name('scoring.store');

    // Participant scoring page
    Route::get(
        '/dashboard/scoring/{match}/{participant}',
        [ScoringController::class, 'participant']
    )
        ->middleware('permission:scoring.view')
        ->name('scoring.participant');

});


/*
|--------------------------------------------------------------------------
| Result
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'permission:result.view'])->group(function () {

    Route::get(
        '/dashboard/result',
        [ResultController::class, 'index']
    )
        ->name('result.index');

});

Route::middleware(['auth', 'permission:user.view'])->group(function () {
    Route::resource('/dashboard/users', UserController::class)->names('users');
});