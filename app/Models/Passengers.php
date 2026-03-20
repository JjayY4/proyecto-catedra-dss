<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passengers extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_passenger';

    protected $fillable = [
        'passport_number', 
        'birthdate', 
        'name', 
        'email', 
        'phone'
    ];
}
