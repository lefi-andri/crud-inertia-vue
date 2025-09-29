<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', \App\Http\Controllers\Site\HomeController::class)->name('home');
Route::get('/about', \App\Http\Controllers\Site\AboutController::class)->name('about');
Route::get('/contact', \App\Http\Controllers\Site\ContactController::class)->name('contact');
Route::get('/learn', \App\Http\Controllers\Site\LearnController::class)->name('learn');

Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
