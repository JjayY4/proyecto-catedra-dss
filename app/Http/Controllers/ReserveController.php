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

public function myReserves()
    {
        if (!auth()->user()->passenger) {
            return redirect()->route('index')->withErrors(['error' => 'No tienes un perfil de pasajero activo.']);
        }

        $passenger = auth()->user()->passenger;
        
        $reserves = Reserves::with(['flight.route', 'flight.airline', 'claims'])
        ->where('id_passengers', $passenger->id_passengers)
        ->where(function($query) {
            $query->whereIn('state_reserve', ['Confirmada']) 
                  ->orWhere(function($q) {
                      $q->where('state_reserve', 'Pendiente')
                        ->where('created_at', '>=', now()->subMinutes(20));
                  });
        })
        ->get();

    return view('reserves.my', compact('reserves'));
    }

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
        'id_flights' => 'required|exists:flights,id_flights',
        'id_seats'   => 'required|exists:seats,id_seats',
    ]);

    try {
        return DB::transaction(function () use ($request) {
            $flight    = Flights::with('airplane')->findOrFail($request->id_flights);
            $passenger = auth()->user()->passenger;

            Reserves::where('state_reserve', 'Pendiente')
                ->where('created_at', '<', now()->subMinutes(20))
                ->delete();

            $existingReserve = Reserves::where('id_flights', $request->id_flights)
                ->where('id_passengers', $passenger->id_passengers)
                ->whereIn('state_reserve', ['Pendiente', 'Confirmada'])
                ->first();

            if ($existingReserve) {
                if ($existingReserve->state_reserve === 'Confirmada') {
                    return back()->withErrors(['error' => 'Ya tenés una reserva confirmada para este vuelo.']);
                }
                return redirect()->route('payments.create', $existingReserve->id_reserves);
            }

            $seat = Seats::where('id_seats', $request->id_seats)
                         ->lockForUpdate()
                         ->firstOrFail();

            $flight = Flights::findOrFail($request->id_flights);
            if ($seat->id_airplanes !== $flight->id_airplanes) {
                return back()->withErrors(['id_seats' => 'El asiento no pertenece a este avión.']);
            }

            $alreadyReserved = Reserves::where('id_flights', $request->id_flights)
                ->where('id_passengers', $passenger->id_passengers)
                ->whereIn('state_reserve', ['Pendiente', 'Confirmada'])
                ->exists();

                Reserves::where('state_reserve', 'Pendiente')
        ->where('created_at', '<', now()->subMinutes(20))
        ->delete();

            if ($alreadyReserved) {
                return back()->withErrors(['error' => 'Ya tenés una reserva activa para este vuelo.']);
            }

            $seatTaken = Reserves::where('id_flights', $request->id_flights)
                ->where('id_seats', $request->id_seats)
                ->whereIn('state_reserve', ['Pendiente', 'Confirmada'])
                ->exists();

            if ($seatTaken) {
                return back()->withErrors(['id_seats' => 'Este asiento ya fue reservado, elegí otro.']);
            }

            $seat = Seats::findOrFail($request->id_seats);

            $multiplier = match($seat->class) {
                'Primera'   => 2.0,
                'Ejecutiva' => 1.5,
                'Económica' => 1.0,
                default     => 1.0,
            };

            $reserve = Reserves::create([
                'id_flights'    => $request->id_flights,
                'id_passengers' => $passenger->id_passengers,
                'id_seats'      => $request->id_seats,
                'state_reserve' => 'Pendiente',
                'date_reserve'  => now(),
                'reserve_code'  => strtoupper(Str::random(8)),
                'total_price'   => $flight->base_rate * $multiplier,
            ]);

            \Illuminate\Support\Facades\DB::table('cache')
        ->where('key', 'like', '%dashboard_stats%')
        ->delete();

            return redirect()->route('payments.create', $reserve->id_reserves);
        });
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Hubo un problema: ' . $e->getMessage()]);
    }
}


    public function confirmation($id_reserves)
{
    $reserve = Reserves::with(['flight.route', 'flight.airline', 'seat'])
            ->where('id_passengers', auth()->user()->passenger->id_passengers)
            ->findOrFail($id_reserves);
            
        return view('reserves.confirmation', compact('reserve'));
}

public function cancel($id_reserves)
{
    $reserve = Reserves::with('flight')->findOrFail($id_reserves);
    $passenger = auth()->user()->passenger;

    if ($reserve->id_passengers !== $passenger->id_passengers) {
        return redirect()->route('reserves.my')->withErrors(['error' => 'No tenés permiso para cancelar esta reserva.']);
    }

    if ($reserve->state_reserve === 'Cancelada') {
        return redirect()->route('reserves.my')->withErrors(['error' => 'Esta reserva ya está cancelada.']);
    }

    if (now()->greaterThanOrEqualTo($reserve->flight->departure_date_time)) {
        return redirect()->route('reserves.my')->withErrors(['error' => 'No podés cancelar una reserva de un vuelo que ya salió.']);
    }

    $reserve->update(['state_reserve' => 'Cancelada']);

    \Illuminate\Support\Facades\DB::table('cache')
        ->where('key', 'like', '%dashboard_stats%')
        ->delete();

    return redirect()->route('reserves.my')->with('success', 'Reserva cancelada correctamente.');
}


}