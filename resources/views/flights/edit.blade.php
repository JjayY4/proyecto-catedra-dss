<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Editar Vuelo</title>
</head>
<body>
    <h1>Editar Vuelo</h1>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p style="color:red;">{{ $error }}</p>
        @endforeach
    @endif

    <form method="POST" action="{{ route('flights.update', $flight->id_flights) }}">
        @csrf
        @method('PATCH')

        <label>Aerolínea:</label><br>
        <select name="id_airlines" required>
            <option value="">Seleccione una aerolínea</option>
            @foreach($airlines as $airline)
                <option value="{{ $airline->id_airlines }}" {{ old('id_airlines', $flight->id_airlines) == $airline->id_airlines ? 'selected' : '' }}>
                    {{ $airline->name }}
                </option>
            @endforeach
        </select>
        @error('id_airlines') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Ruta:</label><br>
        <select name="id_routes" required>
            <option value="">Seleccione una ruta</option>
            @foreach($routes as $route)
                <option value="{{ $route->id_routes }}" {{ old('id_routes', $flight->id_routes) == $route->id_routes ? 'selected' : '' }}>
                    {{ $route->origin_city }} ({{ $route->origin_airport }}) → {{ $route->destination_city }} ({{ $route->destination_airport }})
                </option>
            @endforeach
        </select>
        @error('id_routes') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Avión:</label><br>
        <select name="id_airplanes" required>
            <option value="">Seleccione un avión</option>
            @foreach($airplanes as $airplane)
                <option value="{{ $airplane->id_airplanes }}" {{ old('id_airplanes', $flight->id_airplanes) == $airplane->id_airplanes ? 'selected' : '' }}>
                    {{ $airplane->model }} ({{ $airplane->total_capacity }} asientos)
                </option>
            @endforeach
        </select>
        @error('id_airplanes') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Número de Vuelo:</label><br>
        <input type="text" name="flight_number" value="{{ old('flight_number', $flight->flight_number) }}" required>
        @error('flight_number') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Fecha y Hora de Salida:</label><br>
        <input type="datetime-local" name="departure_date_time" value="{{ old('departure_date_time', date('Y-m-d\TH:i', strtotime($flight->departure_date_time))) }}" required>
        @error('departure_date_time') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Fecha y Hora de Llegada:</label><br>
        <input type="datetime-local" name="arrival_date_time" value="{{ old('arrival_date_time', date('Y-m-d\TH:i', strtotime($flight->arrival_date_time))) }}" required>
        @error('arrival_date_time') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Tarifa Base ($):</label><br>
        <input type="number" name="base_rate" value="{{ old('base_rate', $flight->base_rate) }}" min="1" step="0.01" required>
        @error('base_rate') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Estado:</label><br>
        <select name="state" required>
            <option value="Programado" {{ old('state', $flight->state) == 'Programado' ? 'selected' : '' }}>Programado</option>
            <option value="En vuelo" {{ old('state', $flight->state) == 'En vuelo' ? 'selected' : '' }}>En vuelo</option>
            <option value="Aterrizado" {{ old('state', $flight->state) == 'Aterrizado' ? 'selected' : '' }}>Aterrizado</option>
            <option value="Cancelado" {{ old('state', $flight->state) == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
            <option value="Retrasado" {{ old('state', $flight->state) == 'Retrasado' ? 'selected' : '' }}>Retrasado</option>
        </select>
        @error('state') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <button type="submit">Guardar Cambios</button>
    </form>

    <a href="{{ route('flights.index') }}">Cancelar</a>
</body>
</html>