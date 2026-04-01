<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registrar Vuelo</title>
</head>
<body>
    <nav>
        <a href="{{ route('flights.create') }}">Registrar Vuelo</a>
        <a href="{{ route('flights.index') }}">Ver Vuelos</a>
        <a href="{{ route('routes.create') }}">Registrar Ruta</a>
        <a href="{{ route('routes.index') }}">Ver Rutas</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Cerrar Sesión</button>
        </form>
    </nav>
    <h1>Registrar Nuevo Vuelo</h1>

    <form method="POST" action="{{ route('flights.store') }}">
        @csrf

        <label>Aerolínea:</label><br>
        <select name="id_airlines" required>
            <option value="">Seleccione una aerolínea</option>
            @foreach($airlines as $airline)
                <option value="{{ $airline->id_airlines }}" {{ old('id_airlines') == $airline->id_airlines ? 'selected' : '' }}>
                    {{ $airline->name }}
                </option>
            @endforeach
        </select>
        @error('id_airlines') <div>{{ $message }}</div> @enderror
        <br><br>

        <label>Ruta:</label><br>
        <select name="id_routes" required>
            <option value="">Seleccione una ruta</option>
            @foreach($routes as $route)
                <option value="{{ $route->id_routes }}" {{ old('id_routes') == $route->id_routes ? 'selected' : '' }}>
                    {{ $route->origin_city }} ({{ $route->origin_airport }}) → {{ $route->destination_city }} ({{ $route->destination_airport }})
                </option>
            @endforeach
        </select>
        @error('id_routes') <div>{{ $message }}</div> @enderror
        <br><br>

        <label>Avión:</label><br>
        <select name="id_airplanes" required>
            <option value="">Seleccione un avión</option>
            @foreach($airplanes as $airplane)
                <option value="{{ $airplane->id_airplanes }}" {{ old('id_airplanes') == $airplane->id_airplanes ? 'selected' : '' }}>
                    {{ $airplane->model }} ({{ $airplane->total_capacity }} asientos)
                </option>
            @endforeach
        </select>
        @error('id_airplanes') <div>{{ $message }}</div> @enderror
        <br><br>

        <label>Número de Vuelo:</label><br>
        <input type="text" name="flight_number" value="{{ old('flight_number') }}" placeholder="Ej: AV1234" required>
        @error('flight_number') <div>{{ $message }}</div> @enderror
        <br><br>

        <label>Fecha y Hora de Salida:</label><br>
        <input type="datetime-local" name="departure_date_time" value="{{ old('departure_date_time') }}" required>
        @error('departure_date_time') <div>{{ $message }}</div> @enderror
        <br><br>

        <label>Fecha y Hora de Llegada:</label><br>
        <input type="datetime-local" name="arrival_date_time" value="{{ old('arrival_date_time') }}" required>
        @error('arrival_date_time') <div>{{ $message }}</div> @enderror
        <br><br>

        <label>Tarifa Base ($):</label><br>
        <input type="number" name="base_rate" value="{{ old('base_rate') }}" min="1" step="0.01" required>
        @error('base_rate') <div>{{ $message }}</div> @enderror
        <br><br>

        <button type="submit">Registrar Vuelo</button>
    </form>

    <a href="{{ route('flights.index') }}">Volver a la lista</a>
</body>
</html>