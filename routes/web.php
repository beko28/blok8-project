<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SpelerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PouleController;
use App\Http\Controllers\CompetitieController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::resource('spelers', SpelerController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/{user}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{user}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{user}', [AdminController::class, 'destroy'])->name('admin.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::resource('poules', PouleController::class);
Route::post('/poules/{poule}/koppel-team', [PouleController::class, 'koppelTeam'])->name('poules.koppel-team');

Route::get('/register/step/{step?}', [RegistrationController::class, 'showStep'])->name('register.step');
Route::post('/register/step/{step}', [RegistrationController::class, 'processStep']);

Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
Route::get('/teams/{id}', [TeamController::class, 'show'])->name('teams.show');

Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profiel.update');
Route::delete('/account/{id}', [ProfileController::class, 'destroy'])->name('account.delete');

Route::get('/poules/assign-teams', [PouleController::class, 'assignTeamsToPoules'])->name('poules.assign-teams');
Route::resource('poules', PouleController::class);

Route::get('/competities', [PouleController::class, 'index'])->name('competities.index');
Route::get('/competities/generate', [CompetitieController::class, 'genereerCompetitie']);

Route::post('/aanvraag/{id}/accepteer', [ProfileController::class, 'accepteerAanvraag'])->name('aanvraag.accepteer');
Route::post('/aanvraag/{id}/afwijzen', [ProfileController::class, 'afwijzenAanvraag'])->name('aanvraag.afwijzen');