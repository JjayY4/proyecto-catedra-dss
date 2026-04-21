<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Rutas Registradas</title>
</head>
<body>
    <h1>Rutas Registradas</h1>
    <a href="{{ route('routes.create') }}">Registrar Nueva Ruta</a>
    <br><br>

    @if($routes->isEmpty())
        <p>No hay rutas registradas.</p>
    @else
        @foreach($routes as $route)
            <div>
                <h3>{{ $route->origin_city }} → {{ $route->destination_city }}</h3>
                <p><strong>Origen:</strong> {{ $route->origin_airport }} — {{ $route->origin_city }}</p>
                <p><strong>Destino:</strong> {{ $route->destination_airport }} — {{ $route->destination_city }}</p>
                <p><strong>Distancia:</strong> {{ $route->distance_km }} km</p>
                <p><strong>Duración estimada:</strong> {{ $route->estimated_duration }}</p>

                <form method="POST" action="{{ route('routes.destroy', $route->id_routes) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Eliminar esta ruta?')">Eliminar</button>
                </form>
            </div>

            <a href="{{ route('routes.edit', $route->id_routes) }}">
                <button type="button">Editar</button>
            </a>
            <hr>
        @endforeach
    @endif

    <a href="{{ route('dashboard') }}">Volver al Dashboard</a>
</body>
</html>