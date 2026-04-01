<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Vuelos Registrados</title>
</head>
<body>
    <h1>Vuelos Registrados</h1>
    <a href="{{ route('flights.create') }}">Registrar Nuevo Vuelo</a>
    <br><br>

    @if($flights->isEmpty())
        <p>No hay vuelos registrados.</p>
    @else
        @foreach($flights as $flight)
            <div>
                <h3>{{ $flight->flight_number }}</h3>
                <p><strong>Aerolínea:</strong> {{ $flight->airline->name }}</p>
                <p><strong>Ruta:</strong> {{ $flight->route->origin_city }} → {{ $flight->route->destination_city }}</p>
                <p><strong>Avión:</strong> {{ $flight->airplane->model }}</p>
                <p><strong>Salida:</strong> {{ $flight->departure_date_time }}</p>
                <p><strong>Llegada:</strong> {{ $flight->arrival_date_time }}</p>
                <p><strong>Tarifa base:</strong> ${{ $flight->base_rate }}</p>
                <p><strong>Estado:</strong> {{ $flight->state }}</p>

                <form method="POST" action="{{ route('flights.destroy', $flight->id_flights) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Eliminar este vuelo?')">Eliminar</button>
                </form>
            </div>
            <hr>
        @endforeach
    @endif

    <a href="{{ route('dashboard') }}">Volver al Dashboard</a>
</body>
</html>