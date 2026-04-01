<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registrar Tripulación</title>
</head>
<body>
    <h1>Registrar Miembro de Tripulación</h1>

    <form method="POST" action="{{ route('crews.store') }}">
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

        <label>Nombre Completo:</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required>
        @error('name')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <label>Apodo (opcional):</label><br>
        <input type="text" name="nickname" value="{{ old('nickname') }}">
        @error('nickname')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <label>Cargo:</label><br>
        <select name="post" required>
            <option value="">Seleccione un cargo</option>
            <option value="Piloto" {{ old('post') == 'Piloto' ? 'selected' : '' }}>Piloto</option>
            <option value="Copiloto" {{ old('post') == 'Copiloto' ? 'selected' : '' }}>Copiloto</option>
            <option value="Auxiliar de vuelo" {{ old('post') == 'Auxiliar de vuelo' ? 'selected' : '' }}>Auxiliar de vuelo</option>
            <option value="Técnico" {{ old('post') == 'Técnico' ? 'selected' : '' }}>Técnico</option>
        </select>
        @error('post')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <label>Número de Licencia:</label><br>
        <input type="text" name="license_number" value="{{ old('license_number') }}" placeholder="Ej: ATP-12345" required>
        @error('license_number')
            <div>{{ $message }}</div>
        @enderror
        <br><br>

        <button type="submit">Registrar</button>
    </form>

    <a href="{{ route('crews.index') }}">Volver a la lista</a>
</body>
</html>