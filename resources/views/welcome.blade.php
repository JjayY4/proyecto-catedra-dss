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
    <title>SkyFlow</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white min-h-screen">
<nav class="fixed top-0 left-0 w-full z-50 bg-gray-800 border-b border-gray-700 px-6 py-4 flex items-center justify-between shadow-md">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </div>

                <div>
                    <span class="text-xl font-bold text-white group-hover:text-blue-400 transition">SkyFlow</span>
                </div>
            </a>
    <div class="flex gap-3">
        @if(Route::has('login'))
            @guest
                <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">Iniciar Sesión</a>
                @if(Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">Crear Cuenta</a>
                @endif
            @endguest
        @endif
    </div>
</nav>

<section class="relative overflow-hidden border-b border-gray-800 bg-gradient-to-b from-gray-800 to-gray-900 px-6 pt-36 pb-20 text-center">
    <div class="absolute top-[-100px] left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-blue-600/20 blur-[120px] rounded-full"></div>

    <div class="relative max-w-5xl mx-auto">
        <div class="mb-6">
            <span class="bg-blue-600/20 border border-blue-500/20 text-blue-300 text-sm font-medium px-4 py-1.5 rounded-full">
                Sistema de Gestión de Aerolíneas
            </span>
        </div>

        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 leading-tight">
            El cielo no es el límite,<br>
            <span class="text-blue-500">es tu próximo destino.</span>
        </h1>

        <p class="text-gray-400 text-lg max-w-xl mx-auto mb-10">
            Busque vuelos, explore destinos y planifique su próximo viaje con una experiencia moderna, rápida y segura.
        </p>

        @guest
            <div class="flex gap-4 justify-center mb-14">
                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-xl transition text-lg shadow-lg shadow-blue-900/30">
                    Iniciar Sesión
                </a>
                @if(Route::has('register'))
                    <a href="{{ route('register') }}" class="border border-gray-600 hover:border-gray-400 text-gray-300 hover:text-white font-semibold px-8 py-3 rounded-xl transition text-lg">
                        Crear Cuenta
                    </a>
                @endif
            </div>
        @endguest

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="bg-gray-800/80 backdrop-blur rounded-xl p-6 border border-gray-700 hover:border-blue-500/40 hover:scale-[1.02] transition">
                <div class="bg-blue-600 w-12 h-12 rounded-lg flex items-center justify-center mb-4 mx-auto">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Busque su vuelo</h3>
                <p class="text-gray-400 text-sm">
                    Encuentre vuelos disponibles por origen, destino y fecha de manera rápida y sencilla.
                </p>
            </div>

            <div class="bg-gray-800/80 backdrop-blur rounded-xl p-6 border border-gray-700 hover:border-blue-500/40 hover:scale-[1.02] transition">
                <div class="bg-blue-600 w-12 h-12 rounded-lg flex items-center justify-center mb-4 mx-auto">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Reserve su asiento</h3>
                <p class="text-gray-400 text-sm">
                    Elija su asiento preferido entre primera clase, ejecutiva o económica con precios dinámicos.
                </p>
            </div>

            <div class="bg-gray-800/80 backdrop-blur rounded-xl p-6 border border-gray-700 hover:border-blue-500/40 hover:scale-[1.02] transition">
                <div class="bg-blue-600 w-12 h-12 rounded-lg flex items-center justify-center mb-4 mx-auto">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Pague de forma segura</h3>
                <p class="text-gray-400 text-sm">
                    Confirme su reserva y realice su pago con tarjeta de crédito o débito de forma simulada.
                </p>
            </div>
        </div>
    </div>
</section>

<footer class="border-t border-gray-800 text-center text-gray-500 text-sm py-6">
    © {{ date('Y') }} SkyFlow — Proyecto de Cátedra DSS - Universidad Don Bosco
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>