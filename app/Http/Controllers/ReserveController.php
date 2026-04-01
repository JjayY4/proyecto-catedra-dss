<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flights;
use App\Models\Reserves;
use App\Models\Seats;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReserveController extends Controller
{
    public function create($id_flights)
    {
        $flight = Flights::with(['route', 'airplane', 'airline'])->findOrFail($id_flights);
        
        $seats = Seats::where('id_airplanes', $flight->id_airplanes)->get();

        $reservedSeatIds = Reserves::where('id_flights', $id_flights)
            ->whereIn('state_reserve', ['Pendiente', 'Confirmada'])
            ->pluck('id_seats')
            ->toArray();

        return view('reserves.create', compact('flight', 'seats', 'reservedSeatIds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_flights'  => 'required|exists:flights,id_flights',
            'id_seats'    => 'required|exists:seats,id_seats',
        ]);

        try {
            return DB::transaction(function () use ($request) {
                $flight = Flights::with('airplane')->findOrFail($request->id_flights);

                $seatTaken = Reserves::where('id_flights', $request->id_flights)
                    ->where('id_seats', $request->id_seats)
                    ->whereIn('state_reserve', ['Pendiente', 'Confirmada'])
                    ->exists();

                if ($seatTaken) {
                    return back()->withErrors(['id_seats' => 'Este asiento ya fue reservado, elegí otro.']);
                }

                $passenger = auth()->user()->passenger;

                $reserve = Reserves::create([
                    'id_flights'    => $request->id_flights,
                    'id_passengers' => $passenger->id_passengers,
                    'id_seats'      => $request->id_seats,
                    'state_reserve' => 'Pendiente',
                    'date_reserve'  => now(),
                    'reserve_code'  => strtoupper(Str::random(8)),
                    'total_price'   => $flight->base_rate,
                ]);

                return redirect()->route('payments.create', $reserve->id_reserves);
            });
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Hubo un problema: ' . $e->getMessage()]);
        }
    }
}