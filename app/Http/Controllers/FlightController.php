<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flights;

class FlightController extends Controller
{
    public function search(Request $request)
    {
        $origin = $request->input('origen'); 
        $destination = $request->input('destino');
        $date = $request->input('fecha');

        $query = Flights::with(['route', 'airplane', 'airline'])->where('state', 'Programado');

        if ($origin) {
            $query->whereHas('route', function($q) use ($origin) {
                $q->where(function($subQ) use ($origin) {
                    $subQ->where('origin_city', 'like', "%{$origin}%")
                         ->orWhere('origin_airport', 'like', "%{$origin}%");
                });
            });
        }

        if ($destination) {
            $query->whereHas('route', function($q) use ($destination) {
                $q->where(function($subQ) use ($destination) {
                    $subQ->where('destination_city', 'like', "%{$destination}%")
                         ->orWhere('destination_airport', 'like', "%{$destination}%");
                });
            });
        }

        if ($date) {
            $query->whereDate('departure_date_time', $date);
        }
        $flights = $query->get();

        return view('index', compact('flights'));
    }
}