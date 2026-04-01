<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registrar Ruta</title>
</head>
<body>
    <h1>Registrar Nueva Ruta</h1>

    <form method="POST" action="{{ route('routes.store') }}">
        @csrf

        <label>Aeropuerto de Origen (código IATA):</label><br>
        <input type="text" name="origin_airport" value="{{ old('origin_airport') }}" maxlength="3" placeholder="Ej: SAL" required>
        @error('origin_airport')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <label>Ciudad de Origen:</label><br>
        <input type="text" name="origin_city" value="{{ old('origin_city') }}" placeholder="Ej: San Salvador" required>
        @error('origin_city')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <label>Aeropuerto de Destino (código IATA):</label><br>
        <input type="text" name="destination_airport" value="{{ old('destination_airport') }}" maxlength="3" placeholder="Ej: MIA" required>
        @error('destination_airport')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <label>Ciudad de Destino:</label><br>
        <input type="text" name="destination_city" value="{{ old('destination_city') }}" placeholder="Ej: Miami" required>
        @error('destination_city')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <label>Distancia (km):</label><br>
        <input type="number" name="distance_km" value="{{ old('distance_km') }}" min="1" step="0.01" required>
        @error('distance_km')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <label>Duración Estimada:</label><br>
        <input type="time" name="estimated_duration" value="{{ old('estimated_duration') }}" required>
        @error('estimated_duration')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <button type="submit">Registrar Ruta</button>
    </form>

    <a href="{{ route('routes.index') }}">Volver a la lista</a>
</body>
</html>