<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ComponentExampleController;
use App\Http\Controllers\Admin\PluginExampleController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\ProtectFileManagerActions;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

Route::view('/', 'home')->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('users', UserController::class)
        ->except(['show']);

    Route::resource('categories', CategoryController::class)
        ->except(['show']);

    Route::resource('roles', RoleController::class)
        ->except(['show']);

    Route::get('/examples/plugins', [PluginExampleController::class, 'index'])
        ->name('examples.plugins');

    Route::controller(ComponentExampleController::class)
        ->prefix('examples/components')
        ->name('examples.components.')
        ->group(function () {
            Route::get('forms', 'forms')->name('forms');
            Route::post('forms', 'submitForms')->name('forms.submit');
            Route::post('upload', 'upload')->name('upload');
            Route::get('widgets', 'widgets')->name('widgets');
            Route::get('layout', 'layout')->name('layout');
            Route::get('notifications', 'notifications')->name('notifications');
        });
});

// Laravel Filemanager (UniSharp). Its package routes are disabled in config/lfm.php so they can be protected here.
Route::middleware(['auth', 'verified', 'can:use filemanager'])->group(function () {
    Route::view('/file-manager', 'admin.file-manager')->name('file-manager');

    Route::prefix('filemanager')
        ->middleware(ProtectFileManagerActions::class)
        ->group(fn () => Lfm::routes());
});

require __DIR__.'/auth.php';
