<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\MatchSetupController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ScoringController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('proses');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/dashboard/partisipan', ParticipantController::class)->parameters([
        'partisipan' => 'participant'
    ]);
    Route::resource('/dashboard/competition', CompetitionController::class);
    Route::resource('/dashboard/category', CategoryController::class);
    Route::resource('/dashboard/match', MatchController::class);
    Route::get('/dashboard/match-setup', [MatchSetupController::class, 'index'])
        ->name('match-setup.index');

    Route::post('/dashboard/matches/{match}/participants', [MatchSetupController::class, 'storeParticipant'])
        ->name('match-setup.participants.store');

    Route::put('/dashboard/matches/{match}/participants/{participant}', [MatchSetupController::class, 'updateParticipant'])
        ->name('match-setup.participants.update');

    Route::delete('/dashboard/matches/{match}/participants/{participant}', [MatchSetupController::class, 'destroyParticipant'])
        ->name('match-setup.participants.destroy');

    Route::put(
        '/dashboard/match/{match}/settings',
        [MatchSetupController::class, 'updateSettings']
    )->name('match-setup.settings.update');


    Route::get(
        '/dashboard/scoring',
        [ScoringController::class, 'index']
    )->name('scoring.index');

    Route::post(
        '/dashboard/matches/{match}/scores',
        [ScoringController::class, 'store']
    )->name('scoring.store');

    Route::get(
        '/dashboard/scoring/{match}/{participant}',
        [ScoringController::class, 'participant']
    )->name('scoring.participant');

    Route::get(
        '/dashboard/result',
        [ResultController::class, 'index']
    )->name('result.index');
});
