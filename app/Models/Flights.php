<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flights extends Model
{
    protected $table = 'flights';
    protected $primaryKey = 'id_flights';
    protected $fillable = [
        'id_airplanes', 
        'id_airlines', 
        'id_routes', 
        'flight_number', 
        'departure_date_time', 
        'arrival_date_time', 
        'base_rate', 
        'state'
    ];

    public function route()
    {
        return $this->belongsTo(Routes::class, 'id_routes');
    }

    public function airplane()
    {
        return $this->belongsTo(Airplanes::class, 'id_airplanes');
    }

    public function airline()
    {
        return $this->belongsTo(Airlines::class, 'id_airlines');
    }
}