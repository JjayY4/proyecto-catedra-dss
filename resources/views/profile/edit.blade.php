<!DOCTYPE html>
<html>
<head>
    <title>Mi Perfil</title>
</head>
<body>
    <nav>
        <a href="{{ route('dashboard') }}">Volver al Dashboard</a>
    </nav>
    <hr>

    <h1>Mis Datos Personales</h1>
    
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <label>Nombre Completo:</label><br>
        <input type="text" name="name" value="{{ Auth::user()->name }}" required><br><br>

        <label>Correo Electrónico:</label><br>
        <input type="email" name="email" value="{{ Auth::user()->email }}" required><br><br>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>