<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de Administración</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-900 text-white min-h-screen">
    <nav class="sticky top-0 z-50 border-b border-gray-800 bg-gray-900/95 backdrop-blur">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">

                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </div>

                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-xl font-bold text-white group-hover:text-blue-400 transition">SkyFlow</span>
                        </div>
                    </div>
                </a>

                <div class="flex items-center gap-2">

                    <a href="{{ route('profile') }}"
                        class="flex h-11 w-11 items-center justify-center rounded-xl border border-gray-700 bg-gray-800 text-gray-300 hover:text-white hover:border-blue-500/40 hover:bg-gray-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A10.97 10.97 0 0112 15.5c2.5 0 4.804.835 6.879 2.304M15 11a3 3 0 11-6 0 3 3 0 016 0zm6 1a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex h-11 w-11 items-center justify-center rounded-xl border border-red-500/20 bg-red-600/10 text-red-400 hover:bg-red-600 hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H9m4 8H7a2 2 0 01-2-2V6a2 2 0 012-2h6"/>
                            </svg>
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-10">

        {{-- Header --}}
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-white">Panel de Administración</h1>
            <p class="text-gray-400 mt-1">Bienvenido, <span class="text-blue-400 font-medium">{{ Auth::user()->name }}</span></p>
        </div>

        {{-- Stats --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-10">

    {{-- Pasajeros --}}
    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-5 transition hover:border-blue-500/40">
        <div class="flex items-center justify-between mb-5">
            <div class="hover:border-blue-500">
                <p class="text-gray-400 text-sm">Pasajeros</p>
                <h2 class="text-4xl font-bold text-white mt-1">
                    {{ $stats['passengers'] }}
                </h2>
            </div>

            <div class="w-14 h-14 rounded-2xl bg-blue-600/10 border border-blue-500/20 flex items-center justify-center">
                <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5V4H2v16h5m10 0v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6m10 0H7"/>
                </svg>
            </div>
        </div>

        <p class="text-gray-500 text-sm">
            Usuarios registrados en el sistema
        </p>
    </div>

    {{-- Vuelos --}}
    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-5 transition hover:border-cyan-500/40">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-gray-400 text-sm">Vuelos Activos</p>
                <h2 class="text-4xl font-bold text-white mt-1">
                    {{ $stats['active_flights'] }}
                </h2>
            </div>

            <div class="w-14 h-14 rounded-2xl bg-cyan-600/10 border border-cyan-500/20 flex items-center justify-center">
                <svg class="w-7 h-7 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.5 19l19-7-19-7v5l13 2-13 2v5z"/>
                </svg>
            </div>
        </div>

        <p class="text-gray-500 text-sm">
            Vuelos operando actualmente
        </p>
    </div>

    {{-- Rutas --}}
    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-5 transition hover:border-purple-500/40">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-gray-400 text-sm">Rutas</p>
                <h2 class="text-4xl font-bold text-white mt-1">
                    {{ $stats['routes'] }}
                </h2>
            </div>

            <div class="w-14 h-14 rounded-2xl bg-purple-600/10 border border-purple-500/20 flex items-center justify-center">
                <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 01.553-.894L9 2m0 18l6-3m-6 3V2m6 15l5.447 2.724A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m-6-2l6 2"/>
                </svg>
            </div>
        </div>

        <p class="text-gray-500 text-sm">
            Conexiones aéreas registradas
        </p>
    </div>

    {{-- Aerolíneas --}}
    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-5 transition hover:border-indigo-500/40">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-gray-400 text-sm">Aerolíneas</p>
                <h2 class="text-4xl font-bold text-white mt-1">
                    {{ $stats['airlines'] }}
                </h2>
            </div>

            <div class="w-14 h-14 rounded-2xl bg-indigo-600/10 border border-indigo-500/20 flex items-center justify-center">
                <svg class="w-7 h-7 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 19l9 2-9-18-9 18 9-2z"/>
                </svg>
            </div>
        </div>

        <p class="text-gray-500 text-sm">
            Empresas aéreas disponibles
        </p>
    </div>

    {{-- Aviones --}}
    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-5 transition hover:border-emerald-500/40">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-gray-400 text-sm">Aviones</p>
                <h2 class="text-4xl font-bold text-white mt-1">
                    {{ $stats['airplanes'] }}
                </h2>
            </div>

            <div class="w-14 h-14 rounded-2xl bg-emerald-600/10 border border-emerald-500/20 flex items-center justify-center">
                <svg class="w-7 h-7 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.5 19l19-7-19-7v5l13 2-13 2v5z"/>
                </svg>
            </div>
        </div>

        <p class="text-gray-500 text-sm">
            Flota aérea registrada
        </p>
    </div>

    {{-- Tripulación --}}
    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-5 transition hover:border-pink-500/40">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-gray-400 text-sm">Tripulación</p>
                <h2 class="text-4xl font-bold text-white mt-1">
                    {{ $stats['crews'] }}
                </h2>
            </div>

            <div class="w-14 h-14 rounded-2xl bg-pink-600/10 border border-pink-500/20 flex items-center justify-center">
                <svg class="w-7 h-7 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5V4H2v16h5"/>
                </svg>
            </div>
        </div>

        <p class="text-gray-500 text-sm">
            Personal operativo disponible
        </p>
    </div>

    {{-- Reservas --}}
    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-5 transition hover:border-green-500/40">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-gray-400 text-sm">Reservas</p>
                <h2 class="text-4xl font-bold text-green-400 mt-1">
                    {{ $stats['reserves'] }}
                </h2>
            </div>

            <div class="w-14 h-14 rounded-2xl bg-green-600/10 border border-green-500/20 flex items-center justify-center">
                <svg class="w-7 h-7 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>

        <p class="text-gray-500 text-sm">
            Reservaciones confirmadas
        </p>
    </div>

    {{-- Cancelaciones --}}
    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-5 transition hover:border-red-500/40">
        <div class="flex items-center justify-between mb-5">
            <div>
                <p class="text-gray-400 text-sm">Cancelaciones</p>
                <h2 class="text-4xl font-bold text-red-400 mt-1">
                    {{ $stats['cancellations'] }}
                </h2>
            </div>

            <div class="w-14 h-14 rounded-2xl bg-red-600/10 border border-red-500/20 flex items-center justify-center">
                <svg class="w-7 h-7 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
        </div>

        <p class="text-gray-500 text-sm">
            Reservas canceladas
        </p>
    </div>

</div>
        
        {{-- Menu --}}
        <h2 class="text-xl font-semibold text-white mb-4">Gestión del Sistema</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

            <a href="{{ route('airlines.index') }}" class="bg-gray-800 border border-gray-700 hover:border-blue-500 rounded-xl p-6 flex flex-col gap-3 transition group">
                <div class="bg-blue-600 w-12 h-12 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-white font-semibold group-hover:text-blue-400 transition">Aerolíneas</h3>
                    <p class="text-gray-400 text-sm">Registro y gestión de aerolíneas</p>
                </div>
            </a>

            <a href="{{ route('flights.index') }}" class="bg-gray-800 border border-gray-700 hover:border-blue-500 rounded-xl p-6 flex flex-col gap-3 transition group">
                <div class="bg-blue-600 w-12 h-12 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-white font-semibold group-hover:text-blue-400 transition">Vuelos y Rutas</h3>
                    <p class="text-gray-400 text-sm">Creación de vuelos, rutas y tarifas</p>
                </div>
            </a>

            <a href="{{ route('airplanes.index') }}" class="bg-gray-800 border border-gray-700 hover:border-blue-500 rounded-xl p-6 flex flex-col gap-3 transition group">
                <div class="bg-blue-600 w-12 h-12 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-white font-semibold group-hover:text-blue-400 transition">Aviones y Tripulación</h3>
                    <p class="text-gray-400 text-sm">Administración de flota y personal</p>
                </div>
            </a>

            <a href="{{ route('claims.index') }}" class="bg-gray-800 border border-gray-700 hover:border-blue-500 rounded-xl p-6 flex flex-col gap-3 transition group">
                <div class="bg-red-600 w-12 h-12 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-white font-semibold group-hover:text-red-400 transition">Reclamos</h3>
                    <p class="text-gray-400 text-sm">Procesamiento y gestión de reclamos</p>
                </div>
            </a>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>