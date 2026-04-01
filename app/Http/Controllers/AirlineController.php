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

    public function index()
{
    $airlines = Airlines::all();
    return view('airlines.index', compact('airlines'));
}
}
