<?php
namespace App\Http\Controllers;

use App\Models\Routes;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class RouteController extends Controller
{
    public function index(Request $request)
    {
        $query = Routes::query();

        if ($request->filled('origen')) {
            $query->where(function($q) use ($request) {
                $q->where('origin_city', 'like', '%' . $request->origen . '%')
                  ->orWhere('origin_airport', 'like', '%' . $request->origen . '%');
            });
        }

        if ($request->filled('destino')) {
            $query->where(function($q) use ($request) {
                $q->where('destination_city', 'like', '%' . $request->destino . '%')
                  ->orWhere('destination_airport', 'like', '%' . $request->destino . '%');
            });
        }
        
        $routes = $query->paginate(5)->appends($request->query());
        return view('routes.index', compact('routes'));
    }

    public function create()
    {
        return view('routes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'origin_airport' => [
                'required', 'string', 'size:3', 'alpha', 'uppercase',
                'unique:routes,origin_airport,NULL,id_routes,destination_airport,' . $request->destination_airport
            ],
            'origin_city'         => 'required|string|max:255',
            'destination_airport' => 'required|string|size:3|alpha|uppercase',
            'destination_city'    => 'required|string|max:255',
            'distance_km'         => 'required|numeric|min:1',
            'estimated_duration'  => 'required|date_format:H:i',
        ], $this->messages()); 

        Routes::create($request->all());

        \Illuminate\Support\Facades\DB::table('cache')
        ->where('key', 'like', '%dashboard_stats%')
        ->delete();

        return redirect()->route('routes.index')->with('success', 'Ruta registrada exitosamente.');
    }

    public function edit($id)
    {
        $route = Routes::findOrFail($id);
        return view('routes.edit', compact('route'));
    }

    public function update(Request $request, $id)
    {
        $route = Routes::findOrFail($id);

        $request->validate([
            'origin_airport' => [
                'required', 'string', 'size:3', 'alpha', 'uppercase',
                'unique:routes,origin_airport,' . $id . ',id_routes,destination_airport,' . $request->destination_airport
            ],
            'origin_city'         => 'required|string|max:255',
            'destination_airport' => 'required|string|size:3|alpha|uppercase',
            'destination_city'    => 'required|string|max:255',
            'distance_km'         => 'required|numeric|min:1',
            'estimated_duration'  => 'required|date_format:H:i',
        ], $this->messages()); 

        $route->update($request->all());

        \Illuminate\Support\Facades\DB::table('cache')
        ->where('key', 'like', '%dashboard_stats%')
        ->delete();

        return redirect()->route('routes.index')->with('success', 'Ruta actualizada correctamente.');
    }

    public function destroy($id)
    {
        try {
            $route = Routes::findOrFail($id);
            $route->delete();

            \Illuminate\Support\Facades\DB::table('cache')
            ->where('key', 'like', '%dashboard_stats%')
            ->delete();

            return redirect()->route('routes.index')->with('success', 'Ruta eliminada correctamente.');
        } catch (QueryException $e) {
            return back()->withErrors(['error' => 'No se puede eliminar la ruta porque tiene vuelos asociados.']);
        }
    }

    private function messages()
    {
        return [
            'origin_airport.required'  => 'El código del aeropuerto de origen es obligatorio.',
            'origin_airport.size'      => 'El código de origen debe tener exactamente 3 letras.',
            'origin_airport.alpha'     => 'El código de origen solo puede contener letras.',
            'origin_airport.uppercase' => 'El código de origen debe estar en mayúsculas.',
            'origin_airport.unique'    => 'Ya existe una ruta registrada con esta misma combinación de origen y destino.',
            'origin_city.required'     => 'La ciudad de origen es obligatoria.',
            'origin_city.max'          => 'La ciudad de origen es demasiado larga.',
            'destination_airport.required'  => 'El código del aeropuerto de destino es obligatorio.',
            'destination_airport.size'      => 'El código de destino debe tener exactamente 3 letras.',
            'destination_airport.alpha'     => 'El código de destino solo puede contener letras.',
            'destination_airport.uppercase' => 'El código de destino debe estar en mayúsculas.',
            'destination_city.required'     => 'La ciudad de destino es obligatoria.',
            'destination_city.max'          => 'La ciudad de destino es demasiado larga.',
            'distance_km.required' => 'La distancia en kilómetros es obligatoria.',
            'distance_km.numeric'  => 'La distancia debe ser un número válido.',
            'distance_km.min'      => 'La distancia no puede ser menor a 1 km.',
            'estimated_duration.required'    => 'La duración estimada es obligatoria.',
            'estimated_duration.date_format' => 'El formato de la duración es inválido. Use HH:MM.',
        ];
    }
}