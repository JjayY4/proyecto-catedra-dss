<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\Reserves;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function create($id_reserves)
    {
        $reserve = Reserves::with(['flight.route', 'flight.airline'])
            ->where('id_passengers', auth()->user()->passenger->id_passengers)
            ->findOrFail($id_reserves);

        if ($reserve->state_reserve === 'Confirmada') {
            return redirect()->route('reserves.my')->withErrors(['error' => 'Esta reserva ya fue pagada anteriormente.']);
        }

        return view('payments.create', compact('reserve'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_reserves'    => 'required|exists:reserves,id_reserves',
            'payment_method' => 'required|in:Tarjeta de Crédito,Tarjeta de Débito',
            'card_name'      => 'required|string|max:26',
            'card_number'    => ['required', 'string', 'regex:#^[0-9\s]{16,19}$#'],
            'card_expiry' => [
                    'required', 
                    'string', 
                    'regex:#^(0[1-9]|1[0-2])/\d{2}$#',
                    function ($attribute, $value, $fail) {
                        try {
                            $expiryDate = \Carbon\Carbon::createFromFormat('m/y', $value)->endOfMonth();
                            if ($expiryDate->isPast()) {
                                $fail('La tarjeta ingresada ya se encuentra vencida.');
                            }
                        } catch (\Exception $e) {
                            $fail('La fecha de expiración no es válida.');
                        }
                    }
                ],
            'card_cvv'       => 'required|string|digits:3',
        ], $this->messages()); 

        return DB::transaction(function () use ($request) {
            $reserve = Reserves::where('id_passengers', auth()->user()->passenger->id_passengers)
                ->findOrFail($request->id_reserves);

            if ($reserve->state_reserve === 'Confirmada') {
                return back()->withErrors(['error' => 'Esta reserva ya ha sido pagada. No se procesarán cobros duplicados.']);
            }

            Payments::create([
                'id_reserves'      => $reserve->id_reserves,
                'amount'           => $reserve->total_price,
                'payment_method'   => $request->payment_method,
                'state_payment'    => 'Completado',
                'transaction_code' => 'TX-' . strtoupper(Str::random(10)),
                'payment_date'     => now(),
            ]);

            $reserve->update(['state_reserve' => 'Confirmada']);

            return redirect()->route('reserves.confirmation', $reserve->id_reserves)
                             ->with('success', '¡Pago procesado exitosamente! Su reserva está confirmada.');
        });
    }

    private function messages()
    {
        return [
            'id_reserves.required'    => 'No se detectó una reserva válida para procesar el pago.',
            'id_reserves.exists'      => 'La reserva que intenta pagar no existe o ha expirado.',
            'payment_method.required' => 'Debe seleccionar un método de pago válido.',
            'payment_method.in'       => 'El método de pago debe ser Tarjeta de Crédito o Débito.',
            'card_name.required'      => 'El nombre del titular es obligatorio.',
            'card_name.max'           => 'El nombre del titular no puede exceder los 26 caracteres.',
            'card_number.required'    => 'El número de tarjeta es obligatorio.',
            'card_number.regex'       => 'El formato de la tarjeta es inválido. Debe contener entre 16 y 19 números.',
            'card_expiry.required'    => 'La fecha de expiración es obligatoria.',
            'card_expiry.regex'       => 'La fecha debe tener el formato MM/AA (Ej: 12/26).',
            'card_cvv.required'       => 'El código de seguridad (CVV) es obligatorio.',
            'card_cvv.digits'         => 'El CVV debe contener exactamente 3 números.',
        ];
    }
}