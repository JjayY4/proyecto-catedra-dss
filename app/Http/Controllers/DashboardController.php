<?php

namespace App\Http\Controllers;

use App\Models\Airlines;
use App\Models\Airplanes;
use App\Models\Crew;
use App\Models\Flights;
use App\Models\Routes;
use App\Models\Reserves;
use App\Models\Passengers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'passengers'    => Passengers::count(),
            'active_flights' => Flights::where('state', 'Programado')->count(),
            'routes'        => Routes::count(),
            'airlines'      => Airlines::count(),
            'airplanes'     => Airplanes::count(),
            'crews'         => Crew::count(),
            'reserves'      => Reserves::whereIn('state_reserve', ['Pendiente', 'Confirmada'])->count(),
            'cancellations' => Reserves::where('state_reserve', 'Cancelada')->count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
