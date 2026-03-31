<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airlines extends Model
{
    protected $table = 'airlines';

    protected $primaryKey = 'id_airlines';
    protected $fillable = ['name', 'iata_code', 'description', 'logo_url'];
}
