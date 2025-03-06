<?php

use Illuminate\Support\Facades\Route;

// routes/web.php
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;


Route::get('register', [RegisteredUserController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::post('/forgot-password', [ProfileController::class, 'forgotPassword'])->name('password.email');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('books', BookController::class);
});

// Landing Page for Unauthenticated Users
Route::get('/', [BookController::class, 'landing'])->name('landing');