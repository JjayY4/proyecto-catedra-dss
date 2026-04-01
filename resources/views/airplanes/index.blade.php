<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Aviones Registrados</title>
</head>
<body>
    <h1>Aviones Registrados</h1>
    <a href="{{ route('airplanes.create') }}">Registrar Nuevo Avión</a>
    <br><br>

    @if($airplanes->isEmpty())
        <p>No hay aviones registrados.</p>
    @else
        @foreach($airplanes as $airplane)
    <div>
        <img src="{{ $airplane->image_url }}" alt="Imagen {{ $airplane->model }}" width="80">
        <h3>{{ $airplane->model }}</h3>
        <p><strong>Aerolínea:</strong> {{ $airplane->airline->name }}</p>
        <p><strong>Tipo:</strong> {{ $airplane->type }}</p>
        <p><strong>Capacidad:</strong> {{ $airplane->total_capacity }} pasajeros</p>
        <p><strong>Descripción:</strong> {{ $airplane->description ?? 'Sin descripción' }}</p>

        <form method="POST" action="{{ route('airplanes.destroy', $airplane->id_airplanes) }}">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este avión?')">
                Eliminar
            </button>
        </form>
    </div>
    <hr>
@endforeach
    @endif

    <a href="{{ route('dashboard') }}">Volver al Dashboard</a>
</body>
</html>