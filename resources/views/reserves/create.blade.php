<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Seleccionar Asiento</title>
</head>
<body>
    <h1>Seleccionar Asiento</h1>

    <p><strong>Vuelo:</strong> {{ $flight->flight_number }}</p>
    <p><strong>Aerolínea:</strong> {{ $flight->airline->name }}</p>
    <p><strong>Ruta:</strong> {{ $flight->route->origin_city }} → {{ $flight->route->destination_city }}</p>
    <p><strong>Salida:</strong> {{ $flight->departure_date_time }}</p>
    <p><strong>Tarifa base:</strong> ${{ $flight->base_rate }}</p>

    <hr>

    <div>
        <p>💜 Primera — ${{ $flight->base_rate * 2 }}</p>
        <p>💚 Ejecutiva — ${{ $flight->base_rate * 1.5 }}</p>
        <p>⬜ Económica — ${{ $flight->base_rate }}</p>
        <p>⬛ Ocupado</p>
    </div>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p style="color:red;">{{ $error }}</p>
        @endforeach
    @endif

    <form method="POST" action="{{ route('reserves.store') }}" id="reserve-form">
        @csrf
        <input type="hidden" name="id_flights" value="{{ $flight->id_flights }}">
        <input type="hidden" name="id_seats" id="selected_seat_input" value="">

        <h3>Mapa de Asientos</h3>
        <p>Asiento seleccionado: <strong id="selected-label">Ninguno</strong></p>
        <p>Precio a pagar: <strong id="price-label">—</strong></p>

        @php
            $primeraSeats   = $seats->where('class', 'Primera');
            $ejecutivaSeats = $seats->where('class', 'Ejecutiva');
            $economicaSeats = $seats->where('class', 'Económica');
        @endphp

        <div id="seat-map">
            <p><strong>— Primera clase —</strong></p>
            <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 16px;">
                @foreach($primeraSeats as $seat)
                    @php $ocupado = in_array($seat->id_seats, $reservedSeatIds); @endphp
                    <button type="button"
                        class="seat {{ $ocupado ? 'ocupado' : 'primera' }}"
                        data-id="{{ $seat->id_seats }}"
                        data-number="{{ $seat->seat_number }}"
                        data-class="Primera"
                        data-price="{{ $flight->base_rate * 2 }}"
                        {{ $ocupado ? 'disabled' : '' }}>
                        {{ $seat->seat_number }}
                    </button>
                @endforeach
            </div>

            <p><strong>— Ejecutiva —</strong></p>
            <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 16px;">
                @foreach($ejecutivaSeats as $seat)
                    @php $ocupado = in_array($seat->id_seats, $reservedSeatIds); @endphp
                    <button type="button"
                        class="seat {{ $ocupado ? 'ocupado' : 'ejecutiva' }}"
                        data-id="{{ $seat->id_seats }}"
                        data-number="{{ $seat->seat_number }}"
                        data-class="Ejecutiva"
                        data-price="{{ $flight->base_rate * 1.5 }}"
                        {{ $ocupado ? 'disabled' : '' }}>
                        {{ $seat->seat_number }}
                    </button>
                @endforeach
            </div>

            <p><strong>— Económica —</strong></p>
            <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 16px;">
                @foreach($economicaSeats as $seat)
                    @php $ocupado = in_array($seat->id_seats, $reservedSeatIds); @endphp
                    <button type="button"
                        class="seat {{ $ocupado ? 'ocupado' : 'economica' }}"
                        data-id="{{ $seat->id_seats }}"
                        data-number="{{ $seat->seat_number }}"
                        data-class="Económica"
                        data-price="{{ $flight->base_rate }}"
                        {{ $ocupado ? 'disabled' : '' }}>
                        {{ $seat->seat_number }}
                    </button>
                @endforeach
            </div>
        </div>

        <button type="submit" id="confirm-btn" disabled>Confirmar Asiento y Continuar al Pago</button>
    </form>

    <a href="{{ route('index') }}">Volver</a>

    <style>
        .seat { width: 44px; height: 44px; border-radius: 6px; border: 1px solid #ccc; cursor: pointer; font-size: 11px; font-weight: 500; }
        .primera   { background: #EEEDFE; color: #3C3489; border-color: #AFA9EC; }
        .ejecutiva { background: #E1F5EE; color: #085041; border-color: #5DCAA5; }
        .economica { background: #f5f5f5; color: #333; }
        .ocupado   { background: #ddd; color: #999; cursor: not-allowed; }
        .seleccionado { background: #378ADD; color: #fff; border-color: #185FA5; }
    </style>

    <script>
        document.querySelectorAll('.seat:not(.ocupado)').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.seat.seleccionado').forEach(s => s.classList.remove('seleccionado'));
                btn.classList.add('seleccionado');
                document.getElementById('selected_seat_input').value = btn.dataset.id;
                document.getElementById('selected-label').textContent = btn.dataset.number + ' (' + btn.dataset.class + ')';
                document.getElementById('price-label').textContent = '$' + parseFloat(btn.dataset.price).toFixed(2);
                document.getElementById('confirm-btn').disabled = false;
            });
        });
    </script>
</body>
</html>