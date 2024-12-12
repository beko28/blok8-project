<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SpelerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PouleController;
use App\Http\Controllers\CompetitieController;
use App\Http\Controllers\TeamManagerController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NieuwsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/nieuws/create', [NieuwsController::class, 'create'])->name('nieuws.create');
    Route::post('/nieuws', [NieuwsController::class, 'store'])->name('nieuws.store');
});

Route::get('/nieuws', [NieuwsController::class, 'index'])->name('nieuws.index');
Route::get('/nieuws/create', [NieuwsController::class, 'create'])->name('nieuws.create')->middleware('auth');
Route::post('/nieuws', [NieuwsController::class, 'store'])->name('nieuws.store')->middleware('auth');

Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
Route::post('/teams/{team}/aanmelden', [TeamController::class, 'aanmelden'])->name('teams.aanmelden');
Route::post('/teams/{team}/accepteren', [TeamController::class, 'accepteren'])->name('teams.accepteren');
Route::post('/teams/{team}/weigeren', [TeamController::class, 'weigeren'])->name('teams.weigeren');
Route::post('/teams/{team}/uitnodigen', [TeamController::class, 'uitnodigen'])->name('teams.uitnodigen');
Route::get('/teams/{team}/spelers', [TeamController::class, 'spelers'])->name('teams.spelers');
Route::post('/teams/{team}/spelers/{speler}/verwijderen', [TeamController::class, 'verwijderSpeler'])->name('teams.spelers.verwijderen');


Route::get('/teammanager', [TeamManagerController::class, 'index'])->name('teammanager.index');
Route::post('/teammanager/speler/uitnodigen', [TeamManagerController::class, 'uitnodigen'])->name('teammanager.uitnodigen');
Route::post('/teammanager/aanvraag/{pivotId}/accepteren', [TeamManagerController::class, 'accepteren'])->name('teammanager.accepteren');
Route::post('/teammanager/aanvraag/{pivotId}/weigeren', [TeamManagerController::class, 'weigeren'])->name('teammanager.weigeren');
Route::delete('/teammanager/speler/{pivotId}/verwijderen', [TeamManagerController::class, 'verwijderen'])->name('teammanager.verwijderen');
Route::put('/teammanager/aanpassen', [TeamManagerController::class, 'updateTeam'])->name('teammanager.updateTeam');

Route::get('/login', [\App\Http\Controllers\CustomLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\CustomLoginController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\CustomLoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/chat/{ontvangerEmail}', [ChatController::class, 'index'])->name('chat.show');
    Route::post('/chat/{ontvangerEmail}', [ChatController::class, 'store'])->name('chat.store');
    Route::get('/chat/search', [ChatController::class, 'search'])->name('chat.search');
});

Route::get('/register/step/{step?}', [RegistrationController::class, 'showStep'])->name('register.step');
Route::post('/register/step/{step}', [RegistrationController::class, 'processStep'])->name('register.processStep');

