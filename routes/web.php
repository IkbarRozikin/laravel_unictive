<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\UserClientController;
use App\Http\Controllers\Web\AuthClientController;

// Auth
Route::get('/', [AuthClientController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthClientController::class, 'login']);
Route::get('/register', [AuthClientController::class, 'showRegisterForm']);
Route::post('/register', [AuthClientController::class, 'register']);
// Route::post('/logout', [AuthClientController::class, 'logout'])->name('logout');

// Dashboard User (protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserClientController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserClientController::class, 'create'])->name('users.create');
    Route::post('/users', [UserClientController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserClientController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserClientController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserClientController::class, 'destroy'])->name('users.destroy');
});


