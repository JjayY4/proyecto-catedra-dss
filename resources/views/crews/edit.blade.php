<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Editar Tripulación</title>
</head>
<body>
    <h1>Editar Miembro de Tripulación</h1>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p style="color:red;">{{ $error }}</p>
        @endforeach
    @endif

    <form method="POST" action="{{ route('crews.update', $crew->id_crew_member) }}">
        @csrf
        @method('PATCH')

        <label>Aerolínea:</label><br>
        <select name="id_airlines" required>
            <option value="">Seleccione una aerolínea</option>
            @foreach($airlines as $airline)
                <option value="{{ $airline->id_airlines }}" {{ old('id_airlines', $crew->id_airlines) == $airline->id_airlines ? 'selected' : '' }}>
                    {{ $airline->name }}
                </option>
            @endforeach
        </select>
        @error('id_airlines') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Nombre Completo:</label><br>
        <input type="text" name="name" value="{{ old('name', $crew->name) }}" required>
        @error('name') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Apodo (opcional):</label><br>
        <input type="text" name="nickname" value="{{ old('nickname', $crew->nickname) }}">
        @error('nickname') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Cargo:</label><br>
        <select name="post" required>
            <option value="">Seleccione un cargo</option>
            <option value="Piloto" {{ old('post', $crew->post) == 'Piloto' ? 'selected' : '' }}>Piloto</option>
            <option value="Copiloto" {{ old('post', $crew->post) == 'Copiloto' ? 'selected' : '' }}>Copiloto</option>
            <option value="Auxiliar de vuelo" {{ old('post', $crew->post) == 'Auxiliar de vuelo' ? 'selected' : '' }}>Auxiliar de vuelo</option>
            <option value="Técnico" {{ old('post', $crew->post) == 'Técnico' ? 'selected' : '' }}>Técnico</option>
        </select>
        @error('post') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Número de Licencia:</label><br>
        <input type="text" name="license_number" value="{{ old('license_number', $crew->license_number) }}" placeholder="Ej: ATP-12345" required>
        @error('license_number') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Disponible:</label>
        <input type="checkbox" name="available" value="1" {{ old('available', $crew->available) ? 'checked' : '' }}>
        <br><br>

        <button type="submit">Guardar Cambios</button>
    </form>

    <a href="{{ route('crews.index') }}">Cancelar</a>
</body>
</html>