<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flights;
use App\Models\Routes;
use App\Models\Airplanes;
use App\Models\Airlines;
use App\Models\Crew;

class FlightController extends Controller
{
    public function index()
{
    $flights = Flights::with(['route', 'airplane', 'airline', 'crew'])->paginate(5);
    return view('flights.index', compact('flights'));
}

    public function create()
    {
        $routes = Routes::all();
        $airplanes = Airplanes::all();
        $airlines = Airlines::all();
        $crews = Crew::where('available', true)->get();
        return view('flights.create', compact('routes', 'airplanes', 'airlines', 'crews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_routes'           => 'required|exists:routes,id_routes',
            'id_airplanes'        => 'required|exists:airplanes,id_airplanes',
            'id_airlines'         => 'required|exists:airlines,id_airlines',
            'flight_number'       => 'required|string|unique:flights,flight_number',
            'departure_date_time' => 'required|date|after:now',
            'arrival_date_time'   => 'required|date|after:departure_date_time',
            'base_rate'           => 'required|numeric|min:1',
            'crew_members'        => 'nullable|array',
            'crew_members.*'      => 'exists:crews,id_crew_member'
        ]);

        $flight = Flights::create($request->except('crew_members'));

        if ($request->crew_members) {
            $flight->crew()->sync($request->crew_members);
        }

        return redirect()->route('flights.index')->with('success', 'Vuelo registrado exitosamente.');
        
    }

    public function destroy($id)
    {
        $flight = Flights::findOrFail($id);
        $flight->delete();
        return redirect()->route('flights.index')->with('success', 'Vuelo eliminado correctamente.');
    }

    public function search(Request $request)
    {
        $origin = $request->input('origen');
        $destination = $request->input('destino');
        $date = $request->input('fecha');

        $query = Flights::with(['route', 'airplane', 'airline'])->where('state', 'Programado');

        if ($origin) {
            $query->whereHas('route', function($q) use ($origin) {
                $q->where('origin_city', 'like', "%{$origin}%")
                  ->orWhere('origin_airport', 'like', "%{$origin}%");
            });
        }

        if ($destination) {
            $query->whereHas('route', function($q) use ($destination) {
                $q->where('destination_city', 'like', "%{$destination}%")
                  ->orWhere('destination_airport', 'like', "%{$destination}%");
            });
        }

        if ($date) {
            $query->whereDate('departure_date_time', $date);
        }

        $flights = $query->get();
        return view('index', compact('flights'));
    }

    public function edit($id)
{
    $flight = Flights::findOrFail($id);
    $routes = Routes::all();
    $airplanes = Airplanes::all();
    $airlines = Airlines::all();
    $crews     = Crew::where('available', true)->get();
    $assignedCrew = $flight->crew->pluck('id_crew_member')->toArray();
    return view('flights.edit', compact('flight', 'routes', 'airplanes', 'airlines', 'crews', 'assignedCrew'));
}

public function update(Request $request, $id)
{
    $flight = Flights::findOrFail($id);

    $request->validate([
        'id_routes'           => 'required|exists:routes,id_routes',
        'id_airplanes'        => 'required|exists:airplanes,id_airplanes',
        'id_airlines'         => 'required|exists:airlines,id_airlines',
        'flight_number'       => 'required|string|unique:flights,flight_number,' . $id . ',id_flights',
        'departure_date_time' => 'required|date',
        'arrival_date_time'   => 'required|date|after:departure_date_time',
        'base_rate'           => 'required|numeric|min:1',
        'state'               => 'required|string',
        'crew_members'        => 'nullable|array',
        'crew_members.*'      => 'exists:crews,id_crew_member',
    ]);

    $flight->update($request->except('crew_members'));
    $flight->crew()->sync($request->crew_members ?? []);

    return redirect()->route('flights.index')->with('success', 'Vuelo actualizado correctamente.');
}
}