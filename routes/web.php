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
use App\Http\Middleware\CheckAdminRole;

// public route
Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

// Admin authenticated routes
Route::middleware(['auth', CheckAdminRole::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //airlines: index, create, store, edit, update, destroy
    Route::get('/airlines', [AirlineController::class, 'index'])->name('airlines.index');
    Route::get('/airlines/create', [AirlineController::class, 'create'])->name('airlines.create');
    Route::post('/airlines', [AirlineController::class, 'store'])->name('airlines.store');
    Route::get('/airlines/{id}/edit', [AirlineController::class, 'edit'])->name('airlines.edit');
    Route::patch('/airlines/{id}', [AirlineController::class, 'update'])->name('airlines.update');
    Route::delete('/airlines/{id}', [AirlineController::class, 'destroy'])->name('airlines.destroy');

    //airplanes: index, create, store, edit, update, destroy
    Route::get('/airplanes', [AirplaneController::class, 'index'])->name('airplanes.index');
    Route::get('/airplanes/create', [AirplaneController::class, 'create'])->name('airplanes.create');
    Route::post('/airplanes', [AirplaneController::class, 'store'])->name('airplanes.store');
    Route::get('/airplanes/{id}/edit', [AirplaneController::class, 'edit'])->name('airplanes.edit');
    Route::patch('/airplanes/{id}', [AirplaneController::class, 'update'])->name('airplanes.update');
    Route::delete('/airplanes/{id}', [AirplaneController::class, 'destroy'])->name('airplanes.destroy');

    //crews: index, create, store, edit, update, destroy
    Route::get('/crews', [CrewController::class, 'index'])->name('crews.index');
    Route::get('/crews/create', [CrewController::class, 'create'])->name('crews.create');
    Route::post('/crews', [CrewController::class, 'store'])->name('crews.store');
    Route::get('/crews/{id}/edit', [CrewController::class, 'edit'])->name('crews.edit');
    Route::patch('/crews/{id}', [CrewController::class, 'update'])->name('crews.update');
    Route::delete('/crews/{id}', [CrewController::class, 'destroy'])->name('crews.destroy');

    //routes: index, create, store, edit, update, destroy
    Route::get('/routes', [RouteController::class, 'index'])->name('routes.index');
    Route::get('/routes/create', [RouteController::class, 'create'])->name('routes.create');
    Route::post('/routes', [RouteController::class, 'store'])->name('routes.store');
    Route::get('/routes/{id}/edit', [RouteController::class, 'edit'])->name('routes.edit');
    Route::patch('/routes/{id}', [RouteController::class, 'update'])->name('routes.update');
    Route::delete('/routes/{id}', [RouteController::class, 'destroy'])->name('routes.destroy');

    //flights: index, create, store, edit, update, destroy
    Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
    Route::get('/flights/create', [FlightController::class, 'create'])->name('flights.create');
    Route::post('/flights', [FlightController::class, 'store'])->name('flights.store');
    Route::get('/flights/{id}/edit', [FlightController::class, 'edit'])->name('flights.edit');
    Route::patch('/flights/{id}', [FlightController::class, 'update'])->name('flights.update');
    Route::delete('/flights/{id}', [FlightController::class, 'destroy'])->name('flights.destroy');

    //claims: index, updateState
    Route::get('/claims', [ClaimController::class, 'index'])->name('claims.index');
    Route::patch('/claims/{id}/state', [ClaimController::class, 'updateState'])->name('claims.updateState');
});

// Passenger authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/index', function () {
        return view('index');
    })->name('index');

    //profile: edit
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');

    //flights: search
    Route::get('/vuelos/buscar', [FlightController::class, 'search'])->name('flights.search');

    //reserves: create, store, cancel, confirmation, myReserves
    Route::get('/my-reserves', [ClaimController::class, 'myReserves'])->name('reserves.my');
    Route::get('/reserves/create/{id_flights}', [ReserveController::class, 'create'])->name('reserves.create');
    Route::get('/reserves/confirmation/{id_reserves}', [ReserveController::class, 'confirmation'])->name('reserves.confirmation');
    Route::post('/reserves', [ReserveController::class, 'store'])->name('reserves.store');
    Route::patch('/reserves/{id_reserves}/cancel', [ReserveController::class, 'cancel'])->name('reserves.cancel');

    //Payments: create, store
    Route::get('/payments/create/{id_reserves}', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');

    //claims: create, store, myClaims
    Route::get('/claims/create/{id_reserves}', [ClaimController::class, 'create'])->name('claims.create');
    Route::post('/claims', [ClaimController::class, 'store'])->name('claims.store');
    Route::get('/my-claims', [ClaimController::class, 'myClaims'])->name('claims.my');
});

require __DIR__.'/auth.php';