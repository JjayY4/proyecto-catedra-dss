<?php
namespace App\Http\Controllers;

use App\Models\Airplanes;
use App\Models\Airlines;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class AirplaneController extends Controller
{
    public function index()
    {
        $airplanes = Airplanes::with('airline')->get();
        return view('airplanes.index', compact('airplanes'));
    }

    public function create()
    {
        $airlines = Airlines::all();
        return view('airplanes.create', compact('airlines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_airlines'    => 'required|exists:airlines,id_airlines',
            'model'          => 'required|string|max:255',
            'type'           => 'required|string|max:255',
            'total_capacity' => 'required|integer|min:1|max:853',
            'description'    => 'nullable|string',
            'image'          => 'nullable|image',
        ]);

        $imageUrl = null;

        if ($request->hasFile('image')) {
            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_KEY'),
                    'api_secret' => env('CLOUDINARY_SECRET'),
                ]
            ]);
            $result = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath());
            $imageUrl = $result['secure_url'];
        }

        Airplanes::create([
            'id_airlines'    => $request->id_airlines,
            'model'          => $request->model,
            'type'           => $request->type,
            'total_capacity' => $request->total_capacity,
            'description'    => $request->description,
            'image_url'      => $imageUrl,
        ]);

        return redirect()->route('airplanes.index')->with('success', 'Avión registrado exitosamente.');
    }

    public function edit($id)
{
    $airplane = Airplanes::findOrFail($id);
    $airlines = Airlines::all();
    return view('airplanes.edit', compact('airplane', 'airlines'));
}

public function update(Request $request, $id)
{
    $airplane = Airplanes::findOrFail($id);

    $request->validate([
        'id_airlines'    => 'required|exists:airlines,id_airlines',
        'model'          => 'required|string|max:255',
        'type'           => 'required|string',
        'total_capacity' => 'required|integer|min:1|max:853',
        'description'    => 'nullable|string',
        'image'          => 'nullable|image',
    ]);

    $imageUrl = $airplane->image_url;

    if ($request->hasFile('image')) {
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_KEY'),
                'api_secret' => env('CLOUDINARY_SECRET'),
            ]
        ]);
        $result = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath());
        $imageUrl = $result['secure_url'];
    }

    $airplane->update([
        'id_airlines'    => $request->id_airlines,
        'model'          => $request->model,
        'type'           => $request->type,
        'total_capacity' => $request->total_capacity,
        'description'    => $request->description,
        'image_url'      => $imageUrl,
    ]);

    return redirect()->route('airplanes.index')->with('success', 'Avión actualizado correctamente.');
}

    public function destroy($id)
{
    $airplane = Airplanes::findOrFail($id);
    $airplane->delete();
    return redirect()->route('airplanes.index')->with('success', 'Avión eliminado correctamente.');
}
}