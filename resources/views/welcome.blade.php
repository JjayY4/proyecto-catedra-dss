<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyecto DSS</title>
</head>
<body>
        <h1>Gestion de Aerolíneas</h1>
        @if (Route::has('login'))
            <nav>
                @auth
                    <a href="{{ url('/dashboard') }}">
                        <button>Ir a mi Dashboard</button>
                    </a>
                @else
                    <a href="{{ route('login') }}">
                        <button>Iniciar Sesión</button>
                    </a>
                    
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">
                            <button>Registrarse</button>
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
</body>
</html>