<?php
namespace App\Http\Controllers;

use App\Models\Routes;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Routes::all();
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

    public function destroy($id)
    {
        $route = Routes::findOrFail($id);
        $route->delete();
        return redirect()->route('routes.index')->with('success', 'Ruta eliminada correctamente.');
    }
}