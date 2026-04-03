<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Realizar Pago</title>
</head>
<body>
    <h1>Confirmar y Pagar</h1>

    <h3>Resumen de tu Reserva</h3>
    <p><strong>Código de reserva:</strong> {{ $reserve->reserve_code }}</p>
    <p><strong>Vuelo:</strong> {{ $reserve->flight->flight_number }}</p>
    <p><strong>Aerolínea:</strong> {{ $reserve->flight->airline->name }}</p>
    <p><strong>Ruta:</strong> {{ $reserve->flight->route->origin_city }} → {{ $reserve->flight->route->destination_city }}</p>
    <p><strong>Salida:</strong> {{ $reserve->flight->departure_date_time }}</p>
    <p><strong>Total a pagar:</strong> ${{ $reserve->total_price }}</p>

    <hr>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p style="color:red;">{{ $error }}</p>
        @endforeach
    @endif

    <form method="POST" action="{{ route('payments.store') }}" id="payment-form">
        @csrf
        <input type="hidden" name="id_reserves" value="{{ $reserve->id_reserves }}">

        <h3>Método de Pago</h3>

        <input type="radio" name="payment_method" id="credito" value="Tarjeta de Crédito" required>
        <label for="credito">Tarjeta de Crédito</label><br><br>

        <input type="radio" name="payment_method" id="debito" value="Tarjeta de Débito">
        <label for="debito">Tarjeta de Débito</label><br><br>

        <hr>

        <div id="card-form">
            <h3>Datos de la Tarjeta</h3>

            <label>Nombre en la tarjeta:</label><br>
            <input type="text" name="card_name" id="card_name" placeholder="Ej: JUAN PEREZ" maxlength="26" style="text-transform: uppercase;" value="{{ old('card_name') }}">
            @error('card_name') <div style="color:red;">{{ $message }}</div> @enderror
            <br><br>

            <label>Número de tarjeta:</label><br>
            <input type="text" name="card_number" id="card_number" placeholder="0000 0000 0000 0000" maxlength="19" value="{{ old('card_number') }}">
            @error('card_number') <div style="color:red;">{{ $message }}</div> @enderror
            <br><br>

            <label>Fecha de vencimiento:</label><br>
            <input type="text" name="card_expiry" id="card_expiry" placeholder="MM/AA" maxlength="5" value="{{ old('card_expiry') }}">
            @error('card_expiry') <div style="color:red;">{{ $message }}</div> @enderror
            <br><br>

            <label>CVV:</label><br>
            <input type="password" name="card_cvv" id="card_cvv" placeholder="***" maxlength="3">
            @error('card_cvv') <div style="color:red;">{{ $message }}</div> @enderror
            <br><br>
        </div>

        <button type="submit">Confirmar Pago de ${{ $reserve->total_price }}</button>
    </form>

    <a href="{{ route('index') }}">Cancelar y volver</a>

    <script>
        const cardNumber = document.getElementById('card_number');
        cardNumber.addEventListener('input', () => {
            let val = cardNumber.value.replace(/\D/g, '').substring(0, 16);
            cardNumber.value = val.replace(/(.{4})/g, '$1 ').trim();
        });

        const cardExpiry = document.getElementById('card_expiry');
        cardExpiry.addEventListener('input', () => {
            let val = cardExpiry.value.replace(/\D/g, '').substring(0, 4);
            if (val.length >= 2) val = val.substring(0, 2) + '/' + val.substring(2);
            cardExpiry.value = val;
        });

        const cardName = document.getElementById('card_name');
        cardName.addEventListener('input', () => {
            cardName.value = cardName.value.toUpperCase();
        });
    </script>
</body>
</html>