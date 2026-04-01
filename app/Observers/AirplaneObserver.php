<?php
namespace App\Observers;

use App\Models\Airplanes;
use App\Models\Seats;

class AirplaneObserver
{
    public function created(Airplanes $airplane): void
    {
        $total = $airplane->total_capacity;
        $primera   = (int) round($total * 0.10);
        $ejecutiva = (int) round($total * 0.20);
        $economica = $total - $primera - $ejecutiva;

        $seats = [];

        for ($i = 1; $i <= $primera; $i++) {
            $seats[] = [
                'id_airplanes' => $airplane->id_airplanes,
                'seat_number'  => 'P' . $i,
                'class'        => 'Primera',
                'available'    => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }

        for ($i = 1; $i <= $ejecutiva; $i++) {
            $seats[] = [
                'id_airplanes' => $airplane->id_airplanes,
                'seat_number'  => 'E' . $i,
                'class'        => 'Ejecutiva',
                'available'    => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }

        for ($i = 1; $i <= $economica; $i++) {
            $seats[] = [
                'id_airplanes' => $airplane->id_airplanes,
                'seat_number'  => 'EC' . $i,
                'class'        => 'Económica',
                'available'    => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }

        Seats::insert($seats);
    }
}