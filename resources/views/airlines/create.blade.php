<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registrar Aerolínea</title>
</head>
<body>
    <nav>
        <a href="{{ route('airlines.create') }}">Registrar Aerolínea</a> 
        <a href="{{ route('airlines.index') }}">Ver Aerolíneas</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Cerrar Sesión</button>
        </form>
    </nav>
    <h1>Registrar Nueva Aerolínea</h1>

    <form method="POST" action="{{ route('airlines.store') }}" enctype="multipart/form-data">
        @csrf

        <label>Nombre:</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required>
        @error('name')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <label>Código IATA:</label><br>
        <input type="text" name="iata_code" value="{{ old('iata_code') }}" maxlength="2" required>
        @error('iata_code')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <label>Descripción:</label><br>
        <textarea name="description">{{ old('description') }}</textarea>
        @error('description')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <label>Logo de la Aerolínea:</label><br>
        <input type="file" name="logo" accept="image/*">
        @error('logo')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <button type="submit">Registrar Aerolínea</button>
    </form>
</body>
</html>