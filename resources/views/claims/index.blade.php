<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reclamos</title>
</head>
<body>
    <h1>Gestión de Reclamos</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <form method="GET" action="{{ route('claims.index') }}">
        <label>Filtrar por estado:</label>
        <select name="state" onchange="this.form.submit()">
            <option value="">Todos</option>
            <option value="Abierto" {{ request('state') == 'Abierto' ? 'selected' : '' }}>Abierto</option>
            <option value="En revisión" {{ request('state') == 'En revisión' ? 'selected' : '' }}>En revisión</option>
            <option value="Resuelto" {{ request('state') == 'Resuelto' ? 'selected' : '' }}>Resuelto</option>
        </select>
    </form>
    <br>

    @if($claims->isEmpty())
        <p>No hay reclamos.</p>
    @else
        @foreach($claims as $claim)
            <div>
                <p><strong>Título:</strong> {{ $claim->title }}</p>
                <p><strong>Tipo:</strong> {{ $claim->type }}</p>
                <p><strong>Descripción:</strong> {{ $claim->description }}</p>
                <p><strong>Aerolínea:</strong> {{ $claim->reserve->flight->airline->name }}</p>
                <p><strong>Vuelo:</strong> {{ $claim->reserve->flight->flight_number }}</p>
                <p><strong>Ruta:</strong> {{ $claim->reserve->flight->route->origin_city }} → {{ $claim->reserve->flight->route->destination_city }}</p>
                <p><strong>Fecha:</strong> {{ $claim->creation_date }}</p>
                <p><strong>Estado actual:</strong> {{ $claim->state }}</p>

                <form method="POST" action="{{ route('claims.updateState', $claim->id_claims) }}">
                    @csrf
                    @method('PATCH')
                    <select name="state">
                        <option value="Abierto" {{ $claim->state == 'Abierto' ? 'selected' : '' }}>Abierto</option>
                        <option value="En revisión" {{ $claim->state == 'En revisión' ? 'selected' : '' }}>En revisión</option>
                        <option value="Resuelto" {{ $claim->state == 'Resuelto' ? 'selected' : '' }}>Resuelto</option>
                    </select>
                    <button type="submit">Actualizar Estado</button>
                </form>
            </div>
            <hr>
        @endforeach
    @endif

    <a href="{{ route('dashboard') }}">Volver al Dashboard</a>
</body>
</html>