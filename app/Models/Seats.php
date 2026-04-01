<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seats extends Model
{
    protected $table = 'seats';
    protected $primaryKey = 'id_seats';
    protected $fillable = ['id_airplanes', 'seat_number', 'class', 'available'];

    public function airplane()
    {
        return $this->belongsTo(Airplanes::class, 'id_airplanes', 'id_airplanes');
    }
}