<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// =================== USERS MANAGEMENT (CRUD) =================== //
Route::get('/users', [UserController::class, 'loadAllUsers'])->name('users');
Route::get('/add/user', [UserController::class, 'loadAddUserForm']);
Route::post('/add/user', [UserController::class, 'AddUser'])->name('AddUser');
Route::get('/edit/{id}', [UserController::class, 'loadEditForm']);
Route::post('/edit/user', [UserController::class, 'EditUser'])->name('EditUser');
Route::get('/delete/{id}', [UserController::class, 'deleteUser']);

// =================== AUTHENTICATION (LOGIN & REGISTER) =================== //
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// =================== DASHBOARD (PROTECTED) =================== //
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');

