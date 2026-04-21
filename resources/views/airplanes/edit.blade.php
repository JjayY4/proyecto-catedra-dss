<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Editar Avión</title>
</head>
<body>
    <h1>Editar Avión</h1>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p style="color:red;">{{ $error }}</p>
        @endforeach
    @endif

    <form method="POST" action="{{ route('airplanes.update', $airplane->id_airplanes) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <label>Aerolínea:</label><br>
        <select name="id_airlines" required>
            <option value="">Seleccione una aerolínea</option>
            @foreach($airlines as $airline)
                <option value="{{ $airline->id_airlines }}" {{ old('id_airlines', $airplane->id_airlines) == $airline->id_airlines ? 'selected' : '' }}>
                    {{ $airline->name }}
                </option>
            @endforeach
        </select>
        @error('id_airlines') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Modelo:</label><br>
        <input type="text" name="model" value="{{ old('model', $airplane->model) }}" required>
        @error('model') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Tipo:</label><br>
        <select name="type" required>
            <option value="">Seleccione un tipo</option>
            <option value="narrowbody" {{ old('type', $airplane->type) == 'narrowbody' ? 'selected' : '' }}>Narrowbody</option>
            <option value="widebody" {{ old('type', $airplane->type) == 'widebody' ? 'selected' : '' }}>Widebody</option>
            <option value="regional" {{ old('type', $airplane->type) == 'regional' ? 'selected' : '' }}>Regional</option>
        </select>
        @error('type') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Capacidad Total:</label><br>
        <input type="number" name="total_capacity" value="{{ old('total_capacity', $airplane->total_capacity) }}" min="1" max="853" required>
        @error('total_capacity') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Descripción:</label><br>
        <textarea name="description">{{ old('description', $airplane->description) }}</textarea>
        @error('description') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Imagen actual:</label><br>
        @if($airplane->image_url)
            <img src="{{ $airplane->image_url }}" width="80" alt="Imagen actual"><br>
        @endif
        <label>Cambiar imagen (opcional):</label><br>
        <input type="file" name="image" accept="image/*">
        @error('image') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <button type="submit">Guardar Cambios</button>
    </form>

    <a href="{{ route('airplanes.index') }}">Cancelar</a>
</body>
</html>