<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PelamarDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\LamaranController;

// Halaman awal
Route::get('/', function () {
    return view('index');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Dashboard Routes
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard')
    ->middleware(['auth', 'role:admin']); // Middleware 'admin'

Route::get('/pelamar/dashboard', [PelamarDashboardController::class, 'index'])
    ->name('pelamar.dashboard')
    ->middleware(['auth', 'role:pelamar']);

// User Management
Route::resource('users', UserController::class)->except(['show']);

// Pelamar Management
Route::resource('pelamars', PelamarController::class);
Route::post('/pelamars/schedule', [PelamarController::class, 'schedule'])->name('pelamars.schedule');

// Lowongan Management
Route::resource('lowongans', LowonganController::class);

// Lamaran Management
Route::resource('lamarans', LamaranController::class);
