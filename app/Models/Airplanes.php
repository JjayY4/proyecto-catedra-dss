<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airplanes extends Model
{
    protected $table = 'airplanes';
    protected $primaryKey = 'id_airplanes';
    protected $fillable = ['id_airlines', 'model', 'type', 'total_capacity', 'description', 'image_url'];

    public function airline()
    {
        return $this->belongsTo(Airlines::class, 'id_airlines', 'id_airlines');
    }
}