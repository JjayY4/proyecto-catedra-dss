<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <nav>
        <a href="{{ route('dashboard') }}">Dashboard</a> | 
        <a href="{{ route('profile.edit') }}">Mi Perfil</a> | 
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Cerrar Sesión</button>
        </form>
    </nav>
    <hr>

    <h1>Panel Principal</h1>
    <p>¡Bienvenido, {{ Auth::user()->name }}!</p>
</body>
</html>