<?php
namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\Reserves;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function create($id_reserves)
    {
        $reserve = Reserves::with(['flight.route', 'flight.airline', 'flight.airplane'])->findOrFail($id_reserves);
        return view('payments.create', compact('reserve'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_reserves'    => 'required|exists:reserves,id_reserves',
            'payment_method' => 'required|in:Tarjeta de Crédito,Tarjeta de Débito',
            'card_name'      => 'required|string|max:26',
            'card_number'    => 'required|string|min:19|max:19',
            'card_expiry'    => 'required|string|size:5',
            'card_cvv'       => 'required|string|size:3',
        ]);

        $reserve = Reserves::findOrFail($request->id_reserves);

        Payments::create([
            'id_reserves'      => $reserve->id_reserves,
            'amount'           => $reserve->total_price,
            'payment_method'   => $request->payment_method,
            'state_payment'    => 'Completado',
            'transaction_code' => strtoupper(Str::random(10)),
            'payment_date'     => now(),
        ]);

        $reserve->update(['state_reserve' => 'Confirmada']);

        return redirect()->route('reserves.confirmation', $reserve->id_reserves);
    }

    
}