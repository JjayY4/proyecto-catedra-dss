<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use App\Models\Airlines;
use Illuminate\Http\Request;

class CrewController extends Controller
{
    public function index(Request $request)
    {
        $query = Crew::with('airline');

        if ($request->filled('nombre')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->nombre . '%')
                  ->orWhere('nickname', 'like', '%' . $request->nombre . '%');
            });
        }

        if ($request->filled('cargo')) {
            $query->where('post', 'like', '%' . $request->cargo . '%');
        }

        if ($request->filled('disponible')) {
            $query->where('available', $request->disponible);
        }

        $crews = $query->paginate(5)->appends($request->query());
        
        return view('crews.index', compact('crews'));
    }

    public function create()
    {
        $airlines = Airlines::all();
        return view('crews.create', compact('airlines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_airlines'    => 'required|exists:airlines,id_airlines',
            'name'           => 'required|string|max:255',
            'nickname'       => 'nullable|string|max:255',
            'post'           => 'required|string',
            'license_number' => 'required|string|unique:crews,license_number|regex:/^[A-Z]{3}-[0-9]{5}$/',
            'available'      => 'nullable',
        ], $this->messages());

        Crew::create([
            'id_airlines'    => $request->id_airlines,
            'name'           => $request->name,
            'nickname'       => $request->nickname,
            'post'           => $request->post,
            'license_number' => $request->license_number,
            'available'      => $request->has('available') ? 1 : 0,
        ]);

        \Illuminate\Support\Facades\DB::table('cache')
        ->where('key', 'like', '%dashboard_stats%')
        ->delete();

        return redirect()->route('crews.index')->with('success', 'Miembro de tripulación registrado exitosamente.');
    }

    public function edit($id)
    {
        $crew = Crew::findOrFail($id);
        $airlines = Airlines::all();
        return view('crews.edit', compact('crew', 'airlines'));
    }

    public function update(Request $request, $id)
    {
        $crew = Crew::findOrFail($id);

        $request->validate([
            'id_airlines'    => 'required|exists:airlines,id_airlines',
            'name'           => 'required|string|max:255',
            'nickname'       => 'nullable|string|max:255',
            'post'           => 'required|string',
            'license_number' => 'required|string|regex:/^[A-Z]{3}-[0-9]{5}$/|unique:crews,license_number,' . $id . ',id_crew_member',
            'available'      => 'nullable',
        ], $this->messages());

        $crew->update([
            'id_airlines'    => $request->id_airlines,
            'name'           => $request->name,
            'nickname'       => $request->nickname,
            'post'           => $request->post,
            'license_number' => $request->license_number,
            'available'      => $request->has('available') ? 1 : 0,
        ]);

        \Illuminate\Support\Facades\DB::table('cache')
        ->where('key', 'like', '%dashboard_stats%')
        ->delete();

        return redirect()->route('crews.index')->with('success', 'Miembro actualizado correctamente.');
    }

    public function destroy($id)
    {
        $crew = Crew::findOrFail($id);

        $crew->delete();

        \Illuminate\Support\Facades\DB::table('cache')
        ->where('key', 'like', '%dashboard_stats%')
        ->delete();
        
        return redirect()->route('crews.index')->with('success', 'Miembro eliminado correctamente.');
    }


    private function messages()
    {
        return [
            'id_airlines.required'    => 'Debe seleccionar una aerolínea válida.',
            'id_airlines.exists'      => 'La aerolínea seleccionada no existe en el sistema.',
            'name.required'           => 'El nombre completo es obligatorio.',
            'name.max'                => 'El nombre no puede exceder los 255 caracteres.',
            'nickname.max'            => 'El alias no puede exceder los 255 caracteres.',
            'post.required'           => 'El cargo del tripulante es obligatorio.',
            'license_number.required' => 'El número de licencia es obligatorio.',
            'license_number.unique'   => 'Este número de licencia ya está registrado para otro tripulante.',
            'license_number.regex' => 'El formato de la licencia no es válido. Debe tener exactamente 3 letras mayúsculas, un guion y 5 números (Ej: ATP-12345).',
        ];
    }
}