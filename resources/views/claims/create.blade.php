<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Hacer Reclamo</title>
</head>
<body>
    <h1>Hacer Reclamo</h1>

    <p><strong>Reserva:</strong> {{ $reserve->reserve_code }}</p>
    <p><strong>Vuelo:</strong> {{ $reserve->flight->flight_number }}</p>
    <p><strong>Ruta:</strong> {{ $reserve->flight->route->origin_city }} → {{ $reserve->flight->route->destination_city }}</p>

    <hr>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p style="color:red;">{{ $error }}</p>
        @endforeach
    @endif

    <form method="POST" action="{{ route('claims.store') }}">
        @csrf
        <input type="hidden" name="id_reserves" value="{{ $reserve->id_reserves }}">

        <label>Título del reclamo:</label><br>
        <input type="text" name="title" value="{{ old('title') }}" required>
        @error('title') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Tipo de reclamo:</label><br>
        <select name="type" required>
            <option value="">Seleccioná un tipo</option>
            <option value="Retraso de vuelo" {{ old('type') == 'Retraso de vuelo' ? 'selected' : '' }}>Retraso de vuelo</option>
            <option value="Equipaje dañado" {{ old('type') == 'Equipaje dañado' ? 'selected' : '' }}>Equipaje dañado</option>
            <option value="Equipaje perdido" {{ old('type') == 'Equipaje perdido' ? 'selected' : '' }}>Equipaje perdido</option>
            <option value="Mala atención" {{ old('type') == 'Mala atención' ? 'selected' : '' }}>Mala atención</option>
            <option value="Cobro incorrecto" {{ old('type') == 'Cobro incorrecto' ? 'selected' : '' }}>Cobro incorrecto</option>
            <option value="Otro" {{ old('type') == 'Otro' ? 'selected' : '' }}>Otro</option>
        </select>
        @error('type') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <label>Descripción:</label><br>
        <textarea name="description" rows="5" maxlength="1000" required>{{ old('description') }}</textarea>
        @error('description') <div style="color:red;">{{ $message }}</div> @enderror
        <br><br>

        <button type="submit">Enviar Reclamo</button>
    </form>

    <a href="{{ route('reserves.my') }}">Volver a mis reservas</a>
</body>
</html>