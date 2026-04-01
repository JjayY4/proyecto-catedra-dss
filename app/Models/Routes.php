<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
   protected $table = 'routes';
    protected $primaryKey = 'id_routes';
    protected $fillable = [
        'distance_km',
        'origin_airport',
        'origin_city',
        'destination_airport',
        'destination_city',
        'estimated_duration',
    ];
}
