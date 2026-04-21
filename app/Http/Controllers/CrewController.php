<?php
namespace App\Http\Controllers;

use App\Models\Crew;
use App\Models\Airlines;
use Illuminate\Http\Request;

class CrewController extends Controller
{
    public function index()
    {
        $crews = Crew::with('airline')->get();
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
            'license_number' => 'required|string|unique:crews,license_number|regex:/^[A-Z]{2,4}-[0-9]{4,8}$/',
            'available'      => 'boolean',
        ]);

        Crew::create([
            'id_airlines'    => $request->id_airlines,
            'name'           => $request->name,
            'nickname'       => $request->nickname,
            'post'           => $request->post,
            'license_number' => $request->license_number,
            'available'      => $request->has('available') ? 1 : 1,
        ]);

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
        'license_number' => 'required|string|unique:crews,license_number,' . $id . ',id_crew_member|regex:/^[A-Z]{2,4}-[0-9]{4,8}$/',
        'available'      => 'boolean',
    ]);

    $crew->update([
        'id_airlines'    => $request->id_airlines,
        'name'           => $request->name,
        'nickname'       => $request->nickname,
        'post'           => $request->post,
        'license_number' => $request->license_number,
        'available'      => $request->has('available') ? 1 : 0,
    ]);

    return redirect()->route('crews.index')->with('success', 'Miembro actualizado correctamente.');
}

    public function destroy($id)
    {
        $crew = Crew::findOrFail($id);
        $crew->delete();
        return redirect()->route('crews.index')->with('success', 'Miembro eliminado correctamente.');
    }
}