<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ReserveController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdminRole;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', App\Http\Middleware\CheckAdminRole::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/index', function () {
        return view('index');
    })->name('index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
});

require __DIR__.'/auth.php';

Route::get('/vuelos/buscar', [FlightController::class, 'search'])->name('flights.search');
Route::post('/reservas/crear', [ReserveController::class, 'store'])->name('reserves.store');

