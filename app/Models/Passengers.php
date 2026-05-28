<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passengers extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_passengers';

    protected $fillable = [
        'passport_number', 
        'birthdate', 
        'name', 
        'email', 
        'phone',
        'user_id'
    ];

protected $casts = [
    'passport_number' => 'encrypted',
];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
