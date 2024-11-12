<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware(['role:user'])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [FilmController::class, 'index'])->name('admin.dashboard');

        Route::prefix('films')->name('admin.films.')->group(function () {
            Route::get('/', [FilmController::class, 'index'])->name('index');
            Route::get('/create', [FilmController::class, 'create'])->name('create');
            Route::post('/', [FilmController::class, 'store'])->name('store');
            Route::get('/{film}/edit', [FilmController::class, 'edit'])->name('edit');
            Route::put('/{film}', [FilmController::class, 'update'])->name('update');
            Route::delete('/{film}', [FilmController::class, 'destroy'])->name('destroy');
        });
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
