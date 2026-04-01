<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Proyecto de Cátedra DSS</title>
</head>
<body>
    <nav>
        <a href="{{ route('profile') }}">Mi Perfil</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Cerrar Sesión</button>
        </form>
    </nav>

    <h1>Bienvenido, {{ Auth::user()->name }}</h1>
    <h2>Encuentra tu próximo vuelo</h2>

    <form action="{{ route('flights.search') }}" method="GET">
        <label for="origen">Origen (Ciudad o Aeropuerto):</label><br>
        <input type="text" id="origen" name="origen" value="{{ request('origen') }}" required><br><br>

        <label for="destino">Destino (Ciudad o Aeropuerto):</label><br>
        <input type="text" id="destino" name="destino" value="{{ request('destino') }}" required><br><br>

        <label for="fecha">Fecha del vuelo (Opcional):</label><br>
        <input type="date" id="fecha" name="fecha" value="{{ request('fecha') }}"><br><br>

        <button type="submit">Buscar Vuelos</button>
    </form>

    <br><br>

    @if(isset($flights))
        <h3>Resultados de tu búsqueda:</h3>

        @if(count($flights) > 0)
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>Vuelo</th>
                        <th>Aerolínea</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Salida</th>
                        <th>Llegada</th>
                        <th>Duración</th>
                        <th>Avión</th>
                        <th>Precio Base</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($flights as $vuelo)
                        <tr>
                            <td>{{ $vuelo->flight_number }}</td>
                            <td>{{ $vuelo->airline->name }}</td>
                            <td>{{ $vuelo->route->origin_city }} ({{ $vuelo->route->origin_airport }})</td>
                            <td>{{ $vuelo->route->destination_city }} ({{ $vuelo->route->destination_airport }})</td>
                            <td>{{ $vuelo->departure_date_time }}</td>
                            <td>{{ $vuelo->arrival_date_time }}</td>
                            <td>{{ $vuelo->route->estimated_duration }}</td>
                            <td>{{ $vuelo->airplane->model }}</td>
                            <td>${{ $vuelo->base_rate }}</td>
                            <td>
                                <a href="{{ route('reserves.create', $vuelo->id_flights) }}">
                                    <button type="button">Seleccionar Asiento</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No se encontraron vuelos para esta ruta o fecha.</p>
        @endif
    @endif
</body>
</html>