<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Importo il controller
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LoggedController;
use GuzzleHttp\Middleware;

// Inserisco la route principale
Route::get('/', [GuestController::class, 'index'])
    ->name("project.index");

// Inserisco la search name
Route::get('/searchName', [LoggedController::class, 'searchName'])
    ->middleware(['auth'])
    ->name("project.searchName");

// Inserisco la search id
Route::get('/searchId', [LoggedController::class, 'searchId'])
    ->middleware(['auth'])
    ->name("project.searchId");

// Inserisco la show se loggato
Route::get('/show/{id}', [LoggedController::class, 'show'])
    ->middleware(['auth'])
    ->name("project.show");


// Inserisco la create se loggato
Route::get('/create', [LoggedController::class, 'create'])
    ->middleware(['auth'])
    ->name("project.create");

Route::post('/store', [LoggedController::class, 'store'])
    ->middleware(['auth'])
    ->name("project.store");


// Creo la rotta per lo store della edit
Route::put('/edit/{id}', [LoggedController::class, 'edit'])
    ->middleware(['auth'])
    ->name('project.edit');

Route::post('/update/{id}', [LoggedController::class, 'update'])
    ->middleware(['auth'])
    ->name('project.update');



// Creo la rotta per lo store della delete
Route::delete('/delete/{id}', [LoggedController::class, 'delete'])
    ->middleware(['auth'])
    ->name('project.delete');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
