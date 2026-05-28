<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scale extends Model
{
    protected $fillable = ['id_flights', 'city_scale', 'airport_scale', 'duration', 'order'];

    public function flight() {
        return $this->belongsTo(Flights::class, 'id_flights', 'id_flights');
    }
}
