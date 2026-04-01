<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Aerolíneas Registradas</title>
</head>
<body>
    <h1>Aerolíneas Registradas</h1>
    <a href="{{ route('airlines.create') }}">Registrar Nueva Aerolínea</a>
    <br><br>

    @if($airlines->isEmpty())
        <p>No hay aerolíneas registradas.</p>
    @else
        @foreach($airlines as $airline)
    <div>
        <img src="{{ $airline->logo_url }}" alt="Logo {{ $airline->name }}" width="80">
        <h3>{{ $airline->name }}</h3>
        <p><strong>Código IATA:</strong> {{ $airline->iata_code }}</p>
        <p><strong>Descripción:</strong> {{ $airline->description ?? 'Sin descripción' }}</p>

        <form method="POST" action="{{ route('airlines.destroy', $airline->id_airlines) }}">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('¿Estás seguro de eliminar esta aerolínea?')">
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