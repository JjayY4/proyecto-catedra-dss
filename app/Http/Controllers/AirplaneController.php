<?php
namespace App\Http\Controllers;

use App\Models\Airplanes;
use App\Models\Airlines;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class AirplaneController extends Controller
{
    public function index(Request $request)
    {
        $query = Airplanes::with('airline');

        if ($request->filled('modelo')) {
            $query->where('model', 'like', '%' . $request->modelo . '%');
        }

        if ($request->filled('tipo')) {
            $query->where('type', 'like', '%' . $request->tipo . '%');
        }

        if ($request->filled('id_airlines')) {
            $query->where('id_airlines', $request->id_airlines);
        }

        $airplanes = $query->paginate(5)->appends($request->query());
        
        $airlines = Airlines::all(); 

        return view('airplanes.index', compact('airplanes', 'airlines'));
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
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ], $this->messages());

        $imageUrl = null;

        if ($request->hasFile('image')) {
            try {
                $cloudinary = new Cloudinary([
                    'cloud' => [
                        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                        'api_key'    => env('CLOUDINARY_KEY'),
                        'api_secret' => env('CLOUDINARY_SECRET'),
                    ]
                ]);
                $result = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath());
                $imageUrl = $result['secure_url'];
            } catch (\Exception $e) {
                Log::error('Error subiendo imagen de avión a Cloudinary: ' . $e->getMessage());
                return back()->withInput()->withErrors(['image' => 'Hubo un problema al subir la imagen. Inténtelo de nuevo.']);
            }
        }

        Airplanes::create([
            'id_airlines'    => $request->id_airlines,
            'model'          => $request->model,
            'type'           => $request->type,
            'total_capacity' => $request->total_capacity,
            'description'    => $request->description,
            'image_url'      => $imageUrl,
        ]);
        
        \Illuminate\Support\Facades\DB::table('cache')
        ->where('key', 'like', '%dashboard_stats%')
        ->delete();

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
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], $this->messages());

        $imageUrl = $airplane->image_url;

        if ($request->hasFile('image')) {
            try {
                $cloudinary = new Cloudinary([
                    'cloud' => [
                        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                        'api_key'    => env('CLOUDINARY_KEY'),
                        'api_secret' => env('CLOUDINARY_SECRET'),
                    ]
                ]);
                $result = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath());
                $imageUrl = $result['secure_url'];
            } catch (\Exception $e) {
                Log::error('Error actualizando imagen de avión en Cloudinary: ' . $e->getMessage());
                return back()->withInput()->withErrors(['image' => 'Hubo un problema al subir la nueva imagen.']);
            }
        }

        $airplane->update([
            'id_airlines'    => $request->id_airlines,
            'model'          => $request->model,
            'type'           => $request->type,
            'total_capacity' => $request->total_capacity,
            'description'    => $request->description,
            'image_url'      => $imageUrl,
        ]);

        \Illuminate\Support\Facades\DB::table('cache')
        ->where('key', 'like', '%dashboard_stats%')
        ->delete();

        return redirect()->route('airplanes.index')->with('success', 'Avión actualizado correctamente.');
    }

    public function destroy($id)
    {
        $airplane = Airplanes::findOrFail($id);

        $airplane->delete();

        \Illuminate\Support\Facades\DB::table('cache')
        ->where('key', 'like', '%dashboard_stats%')
        ->delete();

        return redirect()->route('airplanes.index')->with('success', 'Avión eliminado correctamente.');
    }

    private function messages()
    {
        return [
            'id_airlines.required'    => 'Debe seleccionar una aerolínea válida.',
            'id_airlines.exists'      => 'La aerolínea seleccionada no existe en el sistema.',
            'model.required'          => 'El modelo del avión es obligatorio.',
            'model.max'               => 'El modelo no puede exceder los 255 caracteres.',
            'type.required'           => 'El tipo de avión es obligatorio.',
            'type.max'                => 'El tipo no puede exceder los 255 caracteres.',
            'total_capacity.required' => 'La capacidad total de asientos es obligatoria.',
            'total_capacity.integer'  => 'La capacidad debe ser un número entero.',
            'total_capacity.min'      => 'La capacidad mínima es de 1 asiento.',
            'total_capacity.max'      => 'La capacidad no puede exceder los 853 asientos.',
            'image.image'             => 'El archivo subido debe ser una imagen válida.',
            'image.mimes'             => 'La imagen debe estar en formato: jpeg, png, jpg o webp.',
            'image.max'               => 'El tamaño de la imagen no debe superar los 2MB.',
        ];
    }
}