<?php
namespace App\Http\Controllers;

use App\Models\Routes;
use Illuminate\Http\Request;

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
            'origin_airport'      => 'required|string|size:3|alpha|uppercase',
            'origin_city'         => 'required|string|max:255',
            'destination_airport' => 'required|string|size:3|alpha|uppercase',
            'destination_city'    => 'required|string|max:255',
            'distance_km'         => 'required|numeric|min:1',
            'estimated_duration'  => 'required',
        ]);

        Routes::create($request->all());

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
        'origin_airport'      => 'required|string|size:3|alpha|uppercase',
        'origin_city'         => 'required|string|max:255',
        'destination_airport' => 'required|string|size:3|alpha|uppercase',
        'destination_city'    => 'required|string|max:255',
        'distance_km'         => 'required|numeric|min:1',
        'estimated_duration'  => 'required',
    ]);

    $route->update($request->all());

    return redirect()->route('routes.index')->with('success', 'Ruta actualizada correctamente.');
}

    public function destroy($id)
    {
        $route = Routes::findOrFail($id);
        $route->delete();
        return redirect()->route('routes.index')->with('success', 'Ruta eliminada correctamente.');
    }
}