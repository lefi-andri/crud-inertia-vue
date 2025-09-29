<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', \App\Http\Controllers\Site\HomeController::class)->name('home');
Route::get('/about', \App\Http\Controllers\Site\AboutController::class)->name('about');

Route::resource('posts', \App\Http\Controllers\PostController::class);

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
