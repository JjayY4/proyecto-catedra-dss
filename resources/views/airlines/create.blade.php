<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registrar Aerolínea</title>
</head>
<body>
    <h1>Registrar Nueva Aerolínea</h1>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('airlines.store') }}" enctype="multipart/form-data">
        @csrf
        <label>Nombre:</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required><br><br>

        <label>Código IATA:</label><br>
        <input type="text" name="iata_code" value="{{ old('iata_code') }}" required><br><br>

        <label>Descripción:</label><br>
        <textarea name="description">{{ old('description') }}</textarea><br><br>

        <label>Logo de la Aerolínea:</label><br>
        <input type="file" name="logo" accept="image/*"><br><br>

        <button type="submit">Registrar Aerolínea</button>
    </form>
</body>
</html>