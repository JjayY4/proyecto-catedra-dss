<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Editar Aerolínea</title>
</head>
<body>
    <h1>Editar Aerolínea</h1>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p style="color:red;">{{ $error }}</p>
        @endforeach
    @endif

    <form method="POST" action="{{ route('airlines.update', $airline->id_airlines) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <label>Nombre:</label><br>
        <input type="text" name="name" value="{{ old('name', $airline->name) }}" required>
        @error('name') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Código IATA:</label><br>
        <input type="text" name="iata_code" value="{{ old('iata_code', $airline->iata_code) }}" maxlength="2" required>
        @error('iata_code') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Descripción:</label><br>
        <textarea name="description">{{ old('description', $airline->description) }}</textarea>
        @error('description') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Logo actual:</label><br>
        @if($airline->logo_url)
            <img src="{{ $airline->logo_url }}" width="80" alt="Logo actual"><br>
        @endif
        <label>Cambiar logo (opcional):</label><br>
        <input type="file" name="logo" accept="image/*">
        @error('logo') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <button type="submit">Guardar Cambios</button>
    </form>

    <a href="{{ route('airlines.index') }}">Cancelar</a>
</body>
</html>