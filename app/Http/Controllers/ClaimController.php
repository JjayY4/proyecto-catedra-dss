<?php

namespace App\Http\Controllers;

use App\Models\Claims;
use Illuminate\Http\Request;
use App\Models\Reserves;

class ClaimController extends Controller
{
    public function create($id_reserves)
    {
        $reserve = Reserves::with(['flight.route', 'flight.airline'])
            ->findOrFail($id_reserves);

        if ($reserve->id_passengers !== auth()->user()->passenger->id_passengers) {
            abort(403, 'Acceso denegado. Esta reserva no te pertenece.');
        }

        $alreadyClaimed = Claims::where('id_reserves', $id_reserves)
            ->whereIn('state', ['Abierto', 'En revisión'])
            ->exists();

        if ($alreadyClaimed) {
            return redirect()->route('claims.my')->withErrors(['error' => 'Ya tenés un reclamo activo para esta reserva.']);
        }

        return view('claims.create', compact('reserve'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_reserves' => 'required|exists:reserves,id_reserves',
            'title'       => 'required|string|max:255',
            'type'        => 'required|string',
            'description' => 'required|string|min:10|max:1000',
        ]);

        $reserve = Reserves::findOrFail($request->id_reserves);
        if ($reserve->id_passengers !== auth()->user()->passenger->id_passengers) {
            abort(403, 'Acceso denegado. Operación no permitida.');
        }

        Claims::create([
            'id_reserves'   => $request->id_reserves,
            'title'         => $request->title,
            'type'          => $request->type,
            'description'   => $request->description,
            'creation_date' => now(),
            'state'         => 'Abierto',
        ]);

        return redirect()->route('claims.my')->with('success', 'Reclamo enviado correctamente.');
    }

    public function myClaims()
    {
        $passenger = auth()->user()->passenger;
        $claims = Claims::whereHas('reserve', function($q) use ($passenger) {
            $q->where('id_passengers', $passenger->id_passengers);
        })->with('reserve.flight.route')->orderBy('creation_date', 'desc')->paginate(5);

        return view('claims.my', compact('claims'));
    }

    public function index(Request $request)
    {
        $query = Claims::with(['reserve.flight.route', 'reserve.flight.airline']);
        
        if ($request->state) {
            $query->where('state', $request->state);
        }
        
        $claims = $query->orderBy('creation_date', 'desc')->paginate(5)->appends(request()->query());
        
        return view('claims.index', compact('claims'));
    }

    public function updateState(Request $request, $id)
    {
        $request->validate([
            'state' => 'required|in:Abierto,En revisión,Resuelto',
            'admin_response' => 'nullable|string|max:1000',
        ]);

        $claim = Claims::findOrFail($id);
        $claim->update([
            'state' => $request->state,
            'admin_response' => $request->admin_response,]);

        return redirect()->route('claims.index')->with('success', 'Estado actualizado correctamente.');
    }
}