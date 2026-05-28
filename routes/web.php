<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AirplaneController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Ruta pública
Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

// RUTAS DE ADMINISTRADOR
Route::middleware(['auth', 'admin'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Módulos CRUD: Laravel crea las rutas index, create, store, edit, update
    Route::resource('airlines', AirlineController::class);
    Route::resource('airplanes', AirplaneController::class);
    Route::resource('crews', CrewController::class);
    Route::resource('routes', RouteController::class);
    Route::resource('flights', FlightController::class);

    // Reclamos (Rutas específicas)
    Route::get('/claims', [ClaimController::class, 'index'])->name('claims.index');
    Route::patch('/claims/{id}/state', [ClaimController::class, 'updateState'])->name('claims.updateState');
});

// RUTAS DE PASAJERO
Route::middleware('auth')->group(function () {
    
    Route::get('/index', function () {
        return view('index');
    })->name('index');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');

    // Vuelos
    Route::get('/vuelos/buscar', [FlightController::class, 'search'])->name('flights.search');

    // Reservas
    Route::get('/my-reserves', [ReserveController::class, 'myReserves'])->name('reserves.my');
    Route::get('/reserves/create/{id_flights}', [ReserveController::class, 'create'])->name('reserves.create');
    Route::get('/reserves/confirmation/{id_reserves}', [ReserveController::class, 'confirmation'])->name('reserves.confirmation');
    Route::post('/reserves', [ReserveController::class, 'store'])->name('reserves.store');
    Route::patch('/reserves/{id_reserves}/cancel', [ReserveController::class, 'cancel'])->name('reserves.cancel');

    // Pagos
    Route::get('/payments/create/{id_reserves}', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])
    ->middleware(['auth', 'throttle:3,1']) 
    ->name('payments.store');

    // Reclamos
    Route::get('/claims/create/{id_reserves}', [ClaimController::class, 'create'])->name('claims.create');
    Route::post('/claims', [ClaimController::class, 'store'])->name('claims.store');
    Route::get('/my-claims', [ClaimController::class, 'myClaims'])->name('claims.my');
});

require __DIR__.'/auth.php';