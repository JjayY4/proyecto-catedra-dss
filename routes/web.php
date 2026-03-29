<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ReserveController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdminRole;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', CheckAdminRole::class])->group(function () {
Route::get('/admin/dashboard', function () {
    return '¡Bienvenido al panel de administración!';
})->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/vuelos/buscar', [FlightController::class, 'search'])->name('flights.search');
Route::post('/reservas/crear', [ReserveController::class, 'store'])->name('reserves.store');

