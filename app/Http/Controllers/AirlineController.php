<?php

namespace App\Http\Controllers;
use App\Models\Airlines;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class AirlineController extends Controller
{
    public function create()
    {
        return view('airlines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'iata_code'   => 'required|string|size:2|alpha_num|unique:airlines|uppercase',
            'description' => 'nullable|string',
            'logo'        => 'nullable|image',
        ]);
        $logoUrl = null;

        if ($request->hasFile('logo')) {
            $cloudinary = new \Cloudinary\Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_KEY'),
                    'api_secret' => env('CLOUDINARY_SECRET'),
                ]
            ]);

            $result = $cloudinary->uploadApi()->upload($request->file('logo')->getRealPath());
            $logoUrl = $result['secure_url'];
        }

        Airlines::create([
            'name' => $request->name,
            'iata_code' => $request->iata_code,
            'description' => $request->description,
            'logo_url' => $logoUrl,
        ]);

        return redirect()->route('dashboard')->with('success', 'Aerolinea registrada exitosamente.');
    }

    public function index(Request $request)
{
    $query = Airlines::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('iata_code', 'like', "%{$search}%");
    }

    $airlines = $query->paginate(5)->withQueryString();

    return view('airlines.index', compact('airlines'));
}

public function edit($id)
{
    $airline = Airlines::findOrFail($id);
    return view('airlines.edit', compact('airline'));
}

public function update(Request $request, $id)
{
    $airline = Airlines::findOrFail($id);

    $request->validate([
        'name'      => 'required|string|max:255',
        'iata_code' => 'required|string|size:2|alpha_num|uppercase|unique:airlines,iata_code,' . $id . ',id_airlines',
        'description' => 'nullable|string',
        'logo'      => 'nullable|image',
    ]);

    $logoUrl = $airline->logo_url;

    if ($request->hasFile('logo')) {
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_KEY'),
                'api_secret' => env('CLOUDINARY_SECRET'),
            ]
        ]);
        $result = $cloudinary->uploadApi()->upload($request->file('logo')->getRealPath());
        $logoUrl = $result['secure_url'];
    }

    $airline->update([
        'name'        => $request->name,
        'iata_code'   => $request->iata_code,
        'description' => $request->description,
        'logo_url'    => $logoUrl,
    ]);

    return redirect()->route('airlines.index')->with('success', 'Aerolínea actualizada correctamente.');
}

public function destroy($id)
{
    $airline = Airlines::findOrFail($id);
    $airline->delete();
    return redirect()->route('airlines.index')->with('success', 'Aerolínea eliminada correctamente.');
}
}
