<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seats = [];
        $letras = ['A', 'B', 'C', 'D'];
        for ($fila = 1; $fila <= 5; $fila++) {
            foreach ($letras as $letra) {
                $seats[] = [
                    'id_airplanes' => 1,
                    'available' => true,
                    'class' => ($fila <= 2) ? 'Primera Clase' : 'Económica',
                    'seat_number' => $fila . $letra, 
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        DB::table('seats')->insert($seats);
    }
}
