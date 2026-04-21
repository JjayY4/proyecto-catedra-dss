<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Mis Reservas</title>
</head>
<body>
    <h1>Mis Reservas</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p style="color:red;">{{ $error }}</p>
        @endforeach
    @endif

    @if($reserves->isEmpty())
        <p>No tenés reservas confirmadas.</p>
    @else
        @foreach($reserves as $reserve)
            <div>
                <p><strong>Código:</strong> {{ $reserve->reserve_code }}</p>
                <p><strong>Vuelo:</strong> {{ $reserve->flight->flight_number }}</p>
                <p><strong>Ruta:</strong> {{ $reserve->flight->route->origin_city }} → {{ $reserve->flight->route->destination_city }}</p>
                <p><strong>Salida:</strong> {{ $reserve->flight->departure_date_time }}</p>
                <p><strong>Total pagado:</strong> ${{ $reserve->total_price }}</p>
                <p><strong>Estado:</strong> {{ $reserve->state_reserve }}</p>

                @if($reserve->state_reserve !== 'Cancelada')
                    @if($reserve->claims->isEmpty())
                        <a href="{{ route('claims.create', $reserve->id_reserves) }}">
                            <button type="button">Hacer Reclamo</button>
                        </a>
                    @else
                        <p><em>Ya tenés un reclamo para esta reserva.</em></p>
                    @endif

                    @if(now()->lessThan($reserve->flight->departure_date_time))
                        <form method="POST" action="{{ route('reserves.cancel', $reserve->id_reserves) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" onclick="return confirm('¿Estás seguro de cancelar esta reserva?')">
                                Cancelar Reserva
                            </button>
                        </form>
                    @else
                        <p><em>El vuelo ya salió, no se puede cancelar.</em></p>
                    @endif
                @else
                    <p><em>Reserva cancelada.</em></p>
                @endif
            </div>
            <hr>
        @endforeach
    @endif

    <a href="{{ route('index') }}">Volver al inicio</a>
</body>
</html>