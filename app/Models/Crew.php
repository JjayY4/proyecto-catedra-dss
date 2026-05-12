<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    protected $table = 'crews';
    protected $primaryKey = 'id_crew_member';
    protected $fillable = ['id_airlines', 'name', 'nickname', 'post', 'license_number', 'available'];

    public function airline()
    {
        return $this->belongsTo(Airlines::class, 'id_airlines', 'id_airlines');
    }

    public function flights()
    {
        return $this->belongsToMany(Flights::class, 'flight_crew', 'id_crew_member', 'id_flights');
    }
}