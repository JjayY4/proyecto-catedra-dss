<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Mis Reclamos</title>
</head>
<body>
    <h1>Mis Reclamos</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if($claims->isEmpty())
        <p>No tenés reclamos registrados.</p>
    @else
        @foreach($claims as $claim)
            <div>
                <p><strong>Título:</strong> {{ $claim->title }}</p>
                <p><strong>Tipo:</strong> {{ $claim->type }}</p>
                <p><strong>Descripción:</strong> {{ $claim->description }}</p>
                <p><strong>Vuelo:</strong> {{ $claim->reserve->flight->route->origin_city }} → {{ $claim->reserve->flight->route->destination_city }}</p>
                <p><strong>Fecha:</strong> {{ $claim->creation_date }}</p>
                <p><strong>Estado:</strong> {{ $claim->state }}</p>
            </div>
            <hr>
        @endforeach
    @endif

    <a href="{{ route('index') }}">Volver al inicio</a>
</body>
</html>