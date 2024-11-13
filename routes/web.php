<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserFilmController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware(['auth', 'verified'])->group(function () {

        Route::middleware(['role:user'])->group(function () {
            Route::get('/dashboard', [UserFilmController::class, 'index'])->name('dashboard');
            Route::get('/films/{film}', [UserFilmController::class, 'show'])->name('films.show');
        });

        Route::middleware(['role:admin'])->prefix('admin')->group(function () {
            Route::get('/dashboard', [FilmController::class, 'index'])->name('admin.dashboard');

            Route::get('films/{film}/tags/create', [TagController::class, 'createForFilm'])->name('films.tags.create');
            Route::post('films/{film}/tags', [TagController::class, 'storeForFilm'])->name('films.tags.store');
            Route::delete('/tags/{tag}', [TagController::class, 'delete'])->name('admin.tags.delete');

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
});

require __DIR__.'/auth.php';
