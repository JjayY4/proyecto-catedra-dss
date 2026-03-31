<?php
if (auth()->check()) {
    redirect()->route('index')->send();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyecto de Cátedra DSS</title>
</head>
<body>
    <h1>Gestión de Aerolíneas</h1>
    <div>
        @if (Route::has('login'))
            @guest                
                <a href="{{ route('login') }}">
                    <button>Iniciar Sesión</button>
                </a>
                <br><br>
                @if (Route::has('register'))
                    <p>¿Aún no tienes una cuenta?</p>
                    <a href="{{ route('register') }}">
                        <button>Regístrate</button>
                    </a>
                @endif
            @endguest
        @endif
    </div>
</body>
</html>