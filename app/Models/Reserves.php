<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserves extends Model
{
    protected $table = 'reserves';    
    protected $primaryKey = 'id_reserves';

    protected $fillable = [
        'id_passengers', 
        'id_flights', 
        'id_seats', 
        'state_reserve', 
        'reserve_code', 
        'total_price', 
        'date_reserve'
    ];

    public function seat()
{
    return $this->belongsTo(Seats::class, 'id_seats', 'id_seats');
}

public function flight()
{
    return $this->belongsTo(Flights::class, 'id_flights', 'id_flights');
}

public function claims()
{
    return $this->hasMany(Claims::class, 'id_reserves', 'id_reserves');
}
}
