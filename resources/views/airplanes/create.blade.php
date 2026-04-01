<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registrar Avión</title>
</head>
<body>
    <nav>
        <a href="{{ route('airplanes.create') }}">Registrar Avión</a>
        <a href="{{ route('airplanes.index') }}">Ver Aviones</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Cerrar Sesión</button>
        </form>
    </nav>
    <h1>Registrar Nuevo Avión</h1>

    <form method="POST" action="{{ route('airplanes.store') }}" enctype="multipart/form-data">
        @csrf

        <label>Aerolínea:</label><br>
        <select name="id_airlines" required>
            <option value="">Seleccione una aerolínea</option>
            @foreach($airlines as $airline)
                <option value="{{ $airline->id_airlines }}" {{ old('id_airlines') == $airline->id_airlines ? 'selected' : '' }}>
                    {{ $airline->name }}
                </option>
            @endforeach
        </select>
        @error('id_airlines')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <label>Modelo:</label><br>
        <input type="text" name="model" value="{{ old('model') }}" placeholder="Ej: Boeing 737" required>
        @error('model')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <label>Tipo:</label><br>
        <select name="type" required>
            <option value="">Seleccione un tipo</option>
            <option value="narrowbody" {{ old('type') == 'narrowbody' ? 'selected' : '' }}>Narrowbody</option>
            <option value="widebody" {{ old('type') == 'widebody' ? 'selected' : '' }}>Widebody</option>
            <option value="regional" {{ old('type') == 'regional' ? 'selected' : '' }}>Regional</option>
        </select>
        @error('type')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <label>Capacidad Total:</label><br>
        <input type="number" name="total_capacity" value="{{ old('total_capacity') }}" min="1" max="853" required>
        @error('total_capacity')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <label>Descripción:</label><br>
        <textarea name="description">{{ old('description') }}</textarea>
        @error('description')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <label>Imagen del Avión:</label><br>
        <input type="file" name="image" accept="image/*">
        @error('image')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <button type="submit">Registrar Avión</button>
    </form>

    <a href="{{ route('airplanes.index') }}">Volver a la lista</a>
</body>
</html>