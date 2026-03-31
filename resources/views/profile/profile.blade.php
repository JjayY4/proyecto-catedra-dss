<!DOCTYPE html>
<html>
<head>
    <title>Proyecto de Cátedra DSS</title>
</head>
<body>
    <h1>Mis Datos Personales</h1>

    @php $passenger = Auth::user()->passenger; @endphp

    <label>Nombre Completo:</label><br>
    <p>{{ Auth::user()->name }}</p>

    <label>Correo Electrónico:</label><br>
    <p>{{ Auth::user()->email }}</p>

    <label>Fecha de Nacimiento:</label><br>
    <p>{{ $passenger->birthdate ?? 'No registrado' }}</p>

    <label>Teléfono:</label><br>
    <p>{{ $passenger->phone ?? 'No registrado' }}</p>

    <label>Número de Pasaporte:</label><br>
    <p>{{ $passenger->passport_number ?? 'No registrado' }}</p>

</body>
</html>