<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AirplaneController;
use App\Http\Controllers\CrewController;
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
    Route::get('/airplanes', [AirplaneController::class, 'index'])->name('airplanes.index');
    Route::get('/airplanes/create', [AirplaneController::class, 'create'])->name('airplanes.create');
    Route::post('/airplanes', [AirplaneController::class, 'store'])->name('airplanes.store');
    Route::delete('/airlines/{id}', [AirlineController::class, 'destroy'])->name('airlines.destroy');
    Route::delete('/airplanes/{id}', [AirplaneController::class, 'destroy'])->name('airplanes.destroy');
    Route::get('/crews', [CrewController::class, 'index'])->name('crews.index');
    Route::get('/crews/create', [CrewController::class, 'create'])->name('crews.create');
    Route::post('/crews', [CrewController::class, 'store'])->name('crews.store');
    Route::delete('/crews/{id}', [CrewController::class, 'destroy'])->name('crews.destroy');
});

// Solo usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::get('/index', function () {
        return view('index');
    })->name('index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');

    Route::get('/vuelos/buscar', [FlightController::class, 'search'])->name('flights.search');
    Route::post('/reservas/crear', [ReserveController::class, 'store'])->name('reserves.store');
    
});

require __DIR__.'/auth.php';