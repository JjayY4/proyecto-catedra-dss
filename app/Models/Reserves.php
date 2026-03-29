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
}
