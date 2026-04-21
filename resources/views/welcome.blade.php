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
    <title>AeroProject</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white min-h-screen">

    {{-- Navbar --}}
    <nav class="fixed top-0 left-0 w-full z-50 bg-gray-800 border-b border-gray-700 px-6 py-4 flex items-center justify-between shadow-md">
        <div class="flex items-center gap-3">
            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
            </svg>
            <span class="text-xl font-bold text-white">AeroProject</span>
        </div>
        <div class="flex gap-3">
            @if (Route::has('login'))
                @guest
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                        Iniciar Sesión
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                            Crear Cuenta
                        </a>
                    @endif
                @endguest
            @endif
        </div>
    </nav>

    {{-- Hero --}}
    <section class="flex flex-col items-center justify-center text-center px-6 py-24 pt-36">
        <div class="mb-6">
            <span class="bg-blue-600 text-blue-100 text-sm font-medium px-4 py-1.5 rounded-full">Sistema de Gestión de Aerolíneas</span>
        </div>
        <h1 class="text-5xl font-bold text-white mb-6 leading-tight">
            El cielo no es el límite,<br>
            <span class="text-blue-500">es tu próximo destino.</span>
        </h1>
        <p class="text-gray-400 text-lg max-w-xl mb-10">
            Busca vuelos, explora destinos y planifica tu próximo viaje con la mejor experiencia de reserva aérea en línea.
        </p>
        @guest
            <div class="flex gap-4">
                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition text-lg">
                    Iniciar Sesión
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="border border-gray-600 hover:border-gray-400 text-gray-300 hover:text-white font-semibold px-8 py-3 rounded-lg transition text-lg">
                        Crear Cuenta
                    </a>
                @endif
            </div>
        @endguest
    </section>

    {{-- Features --}}
    <section class="px-6 py-16 max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
            <div class="bg-blue-600 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <h3 class="text-white font-semibold text-lg mb-2">Busca tu vuelo</h3>
            <p class="text-gray-400 text-sm">Encuentra vuelos disponibles por origen, destino y fecha de manera rápida y sencilla.</p>
        </div>

        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
            <div class="bg-blue-600 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="text-white font-semibold text-lg mb-2">Reserva tu asiento</h3>
            <p class="text-gray-400 text-sm">Elige tu asiento preferido entre primera clase, ejecutiva o económica con precios dinámicos.</p>
        </div>

        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
            <div class="bg-blue-600 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
            </div>
            <h3 class="text-white font-semibold text-lg mb-2">Paga de forma segura</h3>
            <p class="text-gray-400 text-sm">Confirma tu reserva y realiza tu pago con tarjeta de crédito o débito de forma simulada.</p>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t border-gray-800 text-center text-gray-500 text-sm py-6">
        © {{ date('Y') }} AeroProject — Proyecto de Cátedra DSS - Universidad Don Bosco
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>