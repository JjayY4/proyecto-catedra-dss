<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claims extends Model
{
    protected $table = 'claims';
    protected $primaryKey = 'id_claims';
    protected $fillable = [
        'id_reserves',
        'title',
        'type',
        'description',
        'creation_date',
        'state',
        'admin_response',
    ];

    public function reserve()
    {
        return $this->belongsTo(Reserves::class, 'id_reserves', 'id_reserves');
    }
}
