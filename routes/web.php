<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AirplaneController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdminRole;

// Pública - solo para no autenticados
Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

// Solo Admin
Route::middleware(['auth', CheckAdminRole::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/airlines', [AirlineController::class, 'index'])->name('airlines.index');
    Route::get('/airlines/create', [AirlineController::class, 'create'])->name('airlines.create');
    Route::post('/airlines', [AirlineController::class, 'store'])->name('airlines.store');
});

// Solo usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::get('/index', function () {
        return view('index');
    })->name('index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');

    Route::get('/vuelos/buscar', [FlightController::class, 'search'])->name('flights.search');
    Route::post('/reservas/crear', [ReserveController::class, 'store'])->name('reserves.store');
    Route::get('/airplanes', [AirplaneController::class, 'index'])->name('airplanes.index');
    Route::get('/airplanes/create', [AirplaneController::class, 'create'])->name('airplanes.create');
    Route::post('/airplanes', [AirplaneController::class, 'store'])->name('airplanes.store');
});

require __DIR__.'/auth.php';