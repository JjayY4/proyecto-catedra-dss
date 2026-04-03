<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id_payments';
    protected $fillable = [
        'id_reserves',
        'amount',
        'payment_method',
        'state_payment',
        'transaction_code',
        'payment_date',
    ];

    public function reserve()
    {
        return $this->belongsTo(Reserves::class, 'id_reserves', 'id_reserves');
    }
}