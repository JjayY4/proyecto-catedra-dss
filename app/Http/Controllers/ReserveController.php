<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Flights;
use App\Models\Reserves;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReserveController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_flights' => 'required|exists:flights,id_flights', 
            'id_passengers' => 'required|exists:passengers,id_passengers',
            'id_seats' => 'required|exists:seats,id_seats'
        ]);

        try {
            return DB::transaction(function () use ($request) {
                
                $flight = Flights::with('airplane')->where('id_flights', $request->id_flights)->firstOrFail();

                $currentReservations = Reserves::where('id_flights', $request->id_flights)->count();

                if ($currentReservations >= $flight->airplane->total_capacity) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Ya no hay asientos disponibles en este vuelo.'
                    ], 400);
                }
                $reservation = Reserves::create([
                    'id_flights' => $request->id_flights,
                    'id_passengers' => $request->id_passengers,
                    'id_seats' => $request->id_seats,
                    'state_reserve' => 'Confirmada',
                    'date_reserve' => now(),
                    'reserve_code' => strtoupper(Str::random(8)),
                    'total_price' => $flight->base_rate
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => '¡Reserva creada con éxito!',
                    'data' => $reservation
                ], 201);

            });

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Hubo un problema procesando tu reserva: ' . $e->getMessage()
            ], 500);
        }
    }
}