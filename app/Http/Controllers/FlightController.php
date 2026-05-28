<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flights;
use App\Models\Routes;
use App\Models\Airplanes;
use App\Models\Airlines;
use App\Models\Crew;
use App\Models\Scale;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $query = Flights::with(['route', 'airplane', 'airline', 'crew']);

        if ($request->search) {
            $query->where('flight_number', 'like', "%{$request->search}%");
        }

        if ($request->airline) {
            $query->where('id_airlines', $request->airline);
        }

        if ($request->state) {
            $query->where('state', $request->state);
        }

        $flights = $query->paginate(5)->appends(request()->query());
        $airlines = Airlines::all();

        return view('flights.index', compact('flights', 'airlines'));
    }

    public function create()
    {
        $routes = Routes::all();
        $airplanes = Airplanes::all();
        $airlines = Airlines::all();
        $crews = Crew::where('available', true)
            ->whereDoesntHave('flights', function($q) {
                $q->whereIn('state', ['Programado', 'En vuelo', 'Retrasado']);
            })
            ->get();
            
        return view('flights.create', compact('routes', 'airplanes', 'airlines', 'crews'));
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
        
        $crews = Crew::where('available', true)
            ->whereDoesntHave('flights', function($q) use ($flight) {
                $q->whereIn('flights.state', ['Programado', 'En vuelo', 'Retrasado']) 
                  ->where('flights.id_flights', '!=', $flight->id_flights);            
            })
            ->get();
            
        $assignedCrew = $flight->crew->pluck('id_crew_member')->toArray();
        
        return view('flights.edit', compact('flight', 'routes', 'airplanes', 'airlines', 'crews', 'assignedCrew'));
    }

    public function store(Request $request)
    {
        if ($request->has('scales') && count($request->scales) > 1) {
            return back()->withInput()->withErrors(['scales' => 'El vuelo solo puede tener un máximo de una escala.']);
        }

        $request->validate([
            'id_routes'           => 'required|exists:routes,id_routes',
            'id_airplanes'        => 'required|exists:airplanes,id_airplanes',
            'id_airlines'         => 'required|exists:airlines,id_airlines',
            'flight_number' => 'required|string|regex:/^[A-Z]{2}[0-9]{4}$/|unique:flights,flight_number',
            'departure_date_time' => 'required|date|after:now',
            'arrival_date_time'   => 'required|date|after:departure_date_time',
            'base_rate'           => 'required|numeric|min:1',
            'crew_members'        => 'nullable|array',
        ], $this->messages());

        return DB::transaction(function () use ($request) {
            $flight = Flights::create($request->except(['crew_members', 'scales']));

            if ($request->crew_members) {
                $flight->crew()->sync($request->crew_members);
            }

            if ($request->has('scales')) {
                foreach ($request->scales as $index => $scale) {
                    $flight->scales()->create([
                        'city_scale'    => $scale['city'],
                        'airport_scale' => $scale['airport'],
                        'duration'      => $scale['duration'],
                        'order'         => $index,
                    ]);
                }
            }

            \Illuminate\Support\Facades\DB::table('cache')
                ->where('key', 'like', '%dashboard_stats%')
                ->delete();

            return redirect()->route('flights.index')->with('success', 'Vuelo registrado exitosamente.');
        }); 
    }

    public function update(Request $request, $id)
    {
        if ($request->has('scales') && count($request->scales) > 1) {
            return back()->withInput()->withErrors(['scales' => 'El vuelo solo puede tener un máximo de una escala.']);
        }

        $flight = Flights::findOrFail($id);

        $request->validate([
            'id_routes'           => 'required|exists:routes,id_routes',
            'id_airplanes'        => 'required|exists:airplanes,id_airplanes',
            'id_airlines'         => 'required|exists:airlines,id_airlines',
            'flight_number' => 'required|string|regex:/^[A-Z]{2}[0-9]{4}$/|unique:flights,flight_number,' . $id . ',id_flights',
            'departure_date_time' => 'required|date',
            'arrival_date_time'   => 'required|date|after:departure_date_time',
            'base_rate'           => 'required|numeric|min:1',
            'state'               => 'required|string',
        ], $this->messages());

        return DB::transaction(function () use ($request, $flight) {
            $flight->update($request->except(['crew_members', 'scales']));
            $flight->crew()->sync($request->crew_members ?? []);

            $flight->scales()->delete();
            if ($request->has('scales')) {
                foreach ($request->scales as $index => $scale) {
                    $flight->scales()->create([
                        'city_scale'    => $scale['city'],
                        'airport_scale' => $scale['airport'],
                        'duration'      => $scale['duration'],
                        'order'         => $index,
                    ]);
                }
            }

            \Illuminate\Support\Facades\DB::table('cache')
                ->where('key', 'like', '%dashboard_stats%')
                ->delete();

            return redirect()->route('flights.index')->with('success', 'Vuelo actualizado correctamente.');
        });
    }

    public function destroy($id)
    {
        $flight = Flights::findOrFail($id);
        $flight->delete();

        \Illuminate\Support\Facades\DB::table('cache')
            ->where('key', 'like', '%dashboard_stats%')
            ->delete();
        
        return redirect()->route('flights.index')->with('success', 'Vuelo eliminado correctamente.');
    }

    private function messages()
    {
        return [
            'id_routes.required'           => 'Debe seleccionar una ruta válida.',
            'id_routes.exists'             => 'La ruta seleccionada no existe en el sistema.',
            'id_airplanes.required'        => 'Debe seleccionar un avión.',
            'id_airplanes.exists'          => 'El avión seleccionado no existe en el sistema.',
            'id_airlines.required'         => 'Debe seleccionar una aerolínea.',
            'id_airlines.exists'           => 'La aerolínea seleccionada no existe en el sistema.',
            'flight_number.required'       => 'El número de vuelo es obligatorio.',
            'flight_number.unique'         => 'Este número de vuelo ya se encuentra registrado.',
            'flight_number.regex' => 'El número de vuelo debe tener un formato válido de dos letras mayúsculas y cuatro números (Ej: AV1234).',
            'departure_date_time.required' => 'La fecha y hora de salida es obligatoria.',
            'departure_date_time.after'    => 'La fecha y hora de salida debe ser en el futuro.',
            'arrival_date_time.required'   => 'La fecha y hora de llegada es obligatoria.',
            'arrival_date_time.after'      => 'La fecha de llegada debe ser posterior a la de salida.',
            'base_rate.required'           => 'La tarifa base es obligatoria.',
            'base_rate.numeric'            => 'La tarifa base debe ser un número válido.',
            'base_rate.min'                => 'La tarifa base no puede ser menor a $1.',
            'state.required'               => 'El estado del vuelo es obligatorio.',
            'crew_members.array'           => 'El formato de la tripulación seleccionada no es válido.',
        ];
    }
}