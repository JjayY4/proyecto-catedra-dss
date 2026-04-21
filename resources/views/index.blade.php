<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Busqueda de Vuelos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-gray-800 border-b border-gray-700 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
            </svg>
            <span class="text-xl font-bold text-white">AeroProject</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('reserves.my') }}" class="text-gray-400 hover:text-white text-sm transition">Mis Reservas</a>
            <a href="{{ route('claims.my') }}" class="text-gray-400 hover:text-white text-sm transition">Mis Reclamos</a>
            <a href="{{ route('profile') }}" class="text-gray-400 hover:text-white text-sm transition">Mi Perfil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-lg transition">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </nav>

    {{-- Hero + Search --}}
    <div class="bg-gray-800 border-b border-gray-700 px-6 py-14 text-center">
        <h1 class="text-4xl font-bold text-white mb-2">
            Hola, <span class="text-blue-400">{{ Auth::user()->name }}</span>
        </h1>
        <p class="text-gray-400 mb-10">¿A dónde querés volar hoy?</p>

        <form action="{{ route('flights.search') }}" method="GET" class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <div class="text-left">
                    <label class="block text-gray-400 text-xs mb-1.5">Origen</label>
                    <input type="text" name="origen" value="{{ request('origen') }}" required
                        placeholder="Ciudad o aeropuerto"
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400">
                </div>
                <div class="text-left">
                    <label class="block text-gray-400 text-xs mb-1.5">Destino</label>
                    <input type="text" name="destino" value="{{ request('destino') }}" required
                        placeholder="Ciudad o aeropuerto"
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400">
                </div>
                <div class="text-left">
                    <label class="block text-gray-400 text-xs mb-1.5">Fecha (opcional)</label>
                    <input type="date" name="fecha" value="{{ request('fecha') }}"
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition text-sm">
                        Buscar Vuelos
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Resultados --}}
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

                                {{-- Info principal --}}
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

                                {{-- Info secundaria --}}
                                <div class="flex flex-col md:items-center gap-1">
                                    <p class="text-white font-semibold text-sm">{{ $vuelo->airline->name }}</p>
                                    <p class="text-gray-400 text-xs">{{ $vuelo->flight_number }}</p>
                                    <p class="text-gray-400 text-xs">{{ $vuelo->airplane->model }}</p>
                                </div>

                                {{-- Precio y acción --}}
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

                            {{-- Footer de la card --}}
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
                    <p class="text-gray-500 text-sm mt-1">Intentá con otras fechas o destinos.</p>
                </div>
            @endif

        @else
            <div class="text-center py-20">
                <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <p class="text-gray-400 text-lg">Buscá tu vuelo ideal arriba.</p>
                <p class="text-gray-500 text-sm mt-1">Ingresá origen, destino y fecha para comenzar.</p>
            </div>
        @endif

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>