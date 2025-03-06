<?php

use Illuminate\Support\Facades\Route;

// routes/web.php
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\HomeController;


Route::get('register', [RegisteredUserController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

Route::get('login', [LoginUserController::class, 'showLoginForm'])->name('login');
Route::get('login', [LoginUserController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginUserController::class, 'login']);
Route::post('logout', [LoginUserController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // Home Page
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // User List
    // Route::get('/users', [UserController::class, 'index'])->name('users.index');
    // Book Management
    Route::resource('books', BookController::class);
});

// Landing Page for Unauthenticated Users
Route::get('/', [BookController::class, 'landing'])->name('landing');