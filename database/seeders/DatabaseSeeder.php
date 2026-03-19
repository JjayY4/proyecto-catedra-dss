<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('airlines')->insert([
            'name' => 'Avianca', 
            'iata_code' => 'AVA', 
            'description' => 'Aerolínea principal de El Salvador',
            'created_at' => now(), 
            'updated_at' => now()
        ]);
        DB::table('routes')->insert([
            'distance_km' => 8500.50, 
            'origin_airport' => 'SAL', 
            'origin_city' => 'San Salvador', 
            'destination_airport' => 'MAD', 
            'destination_city' => 'Madrid', 
            'estimated_duration' => '10:30:00', 
            'created_at' => now(), 
            'updated_at' => now()
        ]);
        DB::table('airplanes')->insert([
            'id_airlines' => 1, 
            'model' => 'Airbus A330', 
            'type' => 'Comercial', 
            'total_capacity' => 250, 
            'description' => 'Avión transatlántico',
            'created_at' => now(), 
            'updated_at' => now()
        ]);
        DB::table('flights')->insert([
            'id_airplanes' => 1, 
            'id_airlines' => 1, 
            'id_routes' => 1, 
            'flight_number' => 'AVA-014', 
            'departure_date_time' => '2026-05-15 14:00:00', 
            'arrival_date_time' => '2026-05-16 06:30:00', 
            'base_rate' => 850.00, 
            'state' => 'Programado',
            'created_at' => now(), 
            'updated_at' => now()
        ]);
    }
}
