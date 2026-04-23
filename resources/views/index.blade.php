<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Busqueda de Vuelos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white min-h-screen">
    <nav class="sticky top-0 z-50 border-b border-gray-700/50 bg-gray-900/80 backdrop-blur-xl shadow-md shadow-black/30">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white group-hover:text-blue-400">SkyFlow</span>
                </a>

                <div class="flex items-center gap-2">
                    <a href="{{ route('reserves.my') }}"
                       class="flex h-11 w-11 items-center justify-center rounded-xl border border-gray-700 bg-gray-800 text-gray-300 hover:text-white hover:border-blue-500/40 hover:bg-gray-700 transition"
                       title="Mis Reservas">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
                        </svg>
                    </a>

                    <a href="{{ route('claims.my') }}"
                       class="flex h-11 w-11 items-center justify-center rounded-xl border border-gray-700 bg-gray-800 text-gray-300 hover:text-white hover:border-yellow-500/40 hover:bg-gray-700 transition"
                       title="Mis Reclamos">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>
                    </a>

                    <a href="{{ route('profile') }}"
                       class="flex h-11 w-11 items-center justify-center rounded-xl border border-gray-700 bg-gray-800 text-gray-300 hover:text-white hover:border-blue-500/40 hover:bg-gray-700 transition"
                       title="Mi Perfil">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A10.97 10.97 0 0112 15.5c2.5 0 4.804.835 6.879 2.304M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="flex h-11 w-11 items-center justify-center rounded-xl border border-red-500/20 bg-red-600/10 text-red-400 hover:bg-red-600 hover:text-white transition"
                                title="Cerrar sesión">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H9m4 8H7a2 2 0 01-2-2V6a2 2 0 012-2h6"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <section class="relative overflow-hidden border-b border-gray-800 bg-gradient-to-b from-gray-800 to-gray-900 px-6 py-16">
        <div class="max-w-5xl mx-auto text-center">
            <div class="mb-10">
                <span class="inline-flex items-center gap-2 rounded-full border border-blue-500/20 bg-blue-500/10 px-4 py-1.5 text-sm font-medium text-blue-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    Buscador de vuelos
                </span>
            </div>

            <h1 class="text-4xl md:text-5xl font-bold text-white mb-3 leading-tight">
                Hola, <span class="text-blue-400">{{ Auth::user()->name }}</span>
            </h1>

            <p class="text-gray-400 text-lg mb-10">
                Encuentre su próximo destino de forma rápida y simple.
            </p>

            <div class="max-w-5xl mx-auto rounded-3xl border border-gray-700/80 bg-gray-800/80 backdrop-blur p-4 md:p-5 shadow-2xl">
                <form action="{{ route('flights.search') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-[1fr_1fr_1fr_auto] gap-4 items-end">
                        <div class="text-left">
                            <label for="origen" class="block text-gray-400 text-xs font-medium mb-2 uppercase tracking-wide">
                                Origen
                            </label>
                            <div class="relative">
                                <input
                                    type="text"
                                    id="origen"
                                    name="origen"
                                    value="{{ request('origen') }}"
                                    required
                                    placeholder="Ciudad o aeropuerto"
                                    class="w-full bg-gray-700/80 border border-gray-600 text-white rounded-2xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                                >
                            </div>
                        </div>

                        <div class="text-left">
                            <label for="destino" class="block text-gray-400 text-xs font-medium mb-2 uppercase tracking-wide">
                                Destino
                            </label>
                            <div class="relative">
                                <input
                                    type="text"
                                    id="destino"
                                    name="destino"
                                    value="{{ request('destino') }}"
                                    required
                                    placeholder="Ciudad o aeropuerto"
                                    class="w-full bg-gray-700/80 border border-gray-600 text-white rounded-2xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                                >
                            </div>
                        </div>

                        <div class="text-left">
                            <label for="fecha" class="block text-gray-400 text-xs font-medium mb-2 uppercase tracking-wide">
                                Fecha
                            </label>
                            <div class="relative">
                                <input
                                    type="date"
                                    id="fecha"
                                    name="fecha"
                                    value="{{ request('fecha') }}"
                                    class="w-full bg-gray-700/80 border border-gray-600 text-white rounded-2xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                >
                            </div>
                        </div>

                        <div class="flex items-end">
                            <button
                                type="submit"
                                title="Buscar vuelos"
                                class="h-[54px] w-[54px] rounded-2xl bg-blue-600 hover:bg-blue-700 text-white transition flex items-center justify-center shadow-lg shadow-blue-900/30 hover:scale-[1.03]"
                            >
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 py-10">
        @if(isset($flights))
            @if(count($flights) > 0)
                <h2 class="text-xl font-semibold text-white mb-6">
                    {{ count($flights) }} vuelo(s) encontrado(s)
                </h2>

                <div class="space-y-4">
                    @foreach($flights as $vuelo)
                        <div class="bg-gray-800 border border-gray-700 hover:border-blue-500 rounded-2xl p-6 transition">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex items-center gap-6">
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-white">{{ \Carbon\Carbon::parse($vuelo->departure_date_time)->format('H:i') }}</p>
                                        <p class="text-blue-400 font-semibold text-sm">{{ $vuelo->route->origin_airport }}</p>
                                        <p class="text-gray-400 text-xs">{{ $vuelo->route->origin_city }}</p>
                                    </div>

                                    <div class="flex flex-col items-center gap-1">
                                        <p class="text-gray-400 text-xs">{{ $vuelo->route->estimated_duration }}</p>
                                        <div class="flex items-center gap-1">
                                            <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                            <div class="w-16 h-px bg-gray-600"></div>
                                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                            </svg>
                                            <div class="w-16 h-px bg-gray-600"></div>
                                            <div class="w-2 h-2 rounded-full bg-gray-500"></div>
                                        </div>
                                        <p class="text-gray-500 text-xs">Directo</p>
                                    </div>

                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-white">{{ \Carbon\Carbon::parse($vuelo->arrival_date_time)->format('H:i') }}</p>
                                        <p class="text-gray-400 font-semibold text-sm">{{ $vuelo->route->destination_airport }}</p>
                                        <p class="text-gray-400 text-xs">{{ $vuelo->route->destination_city }}</p>
                                    </div>
                                </div>

                                <div class="flex flex-col md:items-center gap-1">
                                    <p class="text-white font-semibold text-sm">{{ $vuelo->airline->name }}</p>
                                    <p class="text-gray-400 text-xs">{{ $vuelo->flight_number }}</p>
                                    <p class="text-gray-400 text-xs">{{ $vuelo->airplane->model }}</p>
                                </div>

                                <div class="flex flex-col items-end gap-3">
                                    <div class="text-right">
                                        <p class="text-gray-400 text-xs">Desde</p>
                                        <p class="text-3xl font-bold text-white">${{ number_format($vuelo->base_rate, 2) }}</p>
                                        <p class="text-gray-400 text-xs">tarifa base</p>
                                    </div>
                                    <a href="{{ route('reserves.create', $vuelo->id_flights) }}"
                                       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg transition text-sm whitespace-nowrap">
                                        Seleccionar Asiento
                                    </a>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-700 flex gap-6 text-xs text-gray-400">
                                <span>Salida: {{ \Carbon\Carbon::parse($vuelo->departure_date_time)->format('d M Y, H:i') }}</span>
                                <span>Llegada: {{ \Carbon\Carbon::parse($vuelo->arrival_date_time)->format('d M Y, H:i') }}</span>
                                <span class="ml-auto">
                                    <span class="bg-green-900 text-green-300 px-2 py-0.5 rounded-full">{{ $vuelo->state }}</span>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    <p class="text-gray-400 text-lg">No se encontraron vuelos para esta ruta o fecha.</p>
                    <p class="text-gray-500 text-sm mt-1">Intente con otras fechas o destinos.</p>
                </div>
            @endif
        @else
            <div class="text-center py-20">
                <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <p class="text-gray-400 text-lg">Busque su vuelo ideal arriba.</p>
                <p class="text-gray-500 text-sm mt-1">Ingrese origen, destino y fecha para comenzar.</p>
            </div>
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>