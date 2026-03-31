<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Proyecto de Cátedra DSS</title>
</head>
<body>
    <nav>
        <a href="{{ route('profile') }}">Mi Perfil</a> 
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Cerrar Sesión</button>
        </form>
    </nav>
    <h1>Administrador</h1>
    <p>¡Bienvenido, {{ Auth::user()->name }}!</p>
    
    <div>
        <ul>
            <li><a href="{{ route('airlines.create') }}">Registro y Gestión de Aerolíneas</a></li>
            <li>Registro y Gestión de Vuelos</li>
            <li>Administración de Aviones y tripulación</li>
        </ul>
    </div>

    <div>
        <h2>Estadísticas Generales</h2>
        <p>Número de Reservas: <strong>0</strong></p>
        <p>Número de Cancelaciones: <strong>0</strong></p>
        <p>Usuarios Registrados: <strong>0</strong></p>
    </div>

</body>
</html>