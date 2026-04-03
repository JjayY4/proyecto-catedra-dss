<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reserva Confirmada</title>
</head>
<body>
    <h1>¡Reserva Confirmada!</h1>

    <p><strong>Código de reserva:</strong> {{ $reserve->reserve_code }}</p>
    <p><strong>Vuelo:</strong> {{ $reserve->flight->flight_number }}</p>
    <p><strong>Aerolínea:</strong> {{ $reserve->flight->airline->name }}</p>
    <p><strong>Ruta:</strong> {{ $reserve->flight->route->origin_city }} → {{ $reserve->flight->route->destination_city }}</p>
    <p><strong>Salida:</strong> {{ $reserve->flight->departure_date_time }}</p>
    <p><strong>Asiento:</strong> {{ $reserve->seat->seat_number }} — {{ $reserve->seat->class }}</p>
    <p><strong>Total pagado:</strong> ${{ $reserve->total_price }}</p>
    <p><strong>Estado:</strong> {{ $reserve->state_reserve }}</p>

    <a href="{{ route('index') }}">Volver al inicio</a>
</body>
</html>