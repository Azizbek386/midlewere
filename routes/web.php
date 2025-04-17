<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Bosh sahifa
Route::get('/', function () {
    return view('register');
});

// User resource marshrutlari
    Route::resource('users', UserController::class)->names('users');
    Route::get('/login', [UserController::class, 'handleLogin'])->name('handleLogin');
    Route::get('/register', [UserController::class, 'create'])->name('users.create'); // Register sahifasi
    Route::post('/register', [UserController::class, 'register'])->name('register');
    Route::post('/handlelogin', [UserController::class, 'login'])->name('login');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::middleware('auth')->group(function () {
    Route::get('/users/edit/{post}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{post}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

Route::middleware('guest')->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/handlelogin', [UserController::class, 'handleLogin']);
    Route::post('/login', [UserController::class, 'login'])->name('handleLogin');
    Route::get('/register', [UserController::class, 'register'])->name('register'); // Register sahifasi
    Route::post('/users/create', [UserController::class, 'register'])->name('users.create'); // Register sahifasi

});