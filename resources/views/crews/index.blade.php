<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Tripulación</title>
</head>
<body>
    <h1>Tripulación Registrada</h1>
    <a href="{{ route('crews.create') }}">Registrar Nuevo Miembro</a>
    <br><br>

    @if($crews->isEmpty())
        <p>No hay miembros registrados.</p>
    @else
        @foreach($crews as $crew)
            <div>
                <h3>{{ $crew->name }}</h3>
                <p><strong>Aerolínea:</strong> {{ $crew->airline->name }}</p>
                <p><strong>Cargo:</strong> {{ $crew->post }}</p>
                <p><strong>Apodo:</strong> {{ $crew->nickname ?? 'N/A' }}</p>
                <p><strong>Licencia:</strong> {{ $crew->license_number }}</p>
                <p><strong>Disponible:</strong> {{ $crew->available ? 'Sí' : 'No' }}</p>

                <form method="POST" action="{{ route('crews.destroy', $crew->id_crew_member) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Eliminar este miembro?')">Eliminar</button>
                </form>
            </div>
            <hr>
        @endforeach
    @endif

    <a href="{{ route('dashboard') }}">Volver al Dashboard</a>
</body>
</html>