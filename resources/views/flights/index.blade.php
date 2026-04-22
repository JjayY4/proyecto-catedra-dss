<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vuelos Registrados</title>
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
            <span class="ml-2 bg-blue-600 text-blue-100 text-xs font-medium px-2.5 py-0.5 rounded-full">Administrador</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white text-sm transition">Panel de Administración</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-lg transition">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-6 py-10">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white">Vuelos</h1>
                <p class="text-gray-400 mt-1">Gestión de vuelos registrados</p>
            </div>
            <a href="{{ route('flights.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nuevo Vuelo
            </a>
        </div>

        {{-- Alertas --}}
        @if(session('success'))
            <div class="bg-green-900 border border-green-700 text-green-300 px-4 py-3 rounded-lg mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Lista --}}
        @if($flights->isEmpty())
            <div class="text-center py-20">
                <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                <p class="text-gray-400 text-lg">No hay vuelos registrados.</p>
                <a href="{{ route('flights.create') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition">
                    Registrar primer vuelo
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($flights as $flight)
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6">

                        {{-- Header --}}
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="bg-blue-600 w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white font-bold text-lg">{{ $flight->flight_number }}</p>
                                    <p class="text-gray-400 text-sm">{{ $flight->airline->name }}</p>
                                </div>
                            </div>
                            <span class="text-xs font-semibold px-3 py-1 rounded-full
                                @if($flight->state === 'Programado') bg-blue-900 text-blue-300
                                @elseif($flight->state === 'En vuelo') bg-green-900 text-green-300
                                @elseif($flight->state === 'Aterrizado') bg-gray-700 text-gray-300
                                @elseif($flight->state === 'Cancelado') bg-red-900 text-red-300
                                @else bg-yellow-900 text-yellow-300
                                @endif">
                                {{ $flight->state }}
                            </span>
                        </div>

                        {{-- Ruta --}}
                        <div class="flex items-center gap-4 mb-4">
                            <div class="text-center">
                                <p class="text-xl font-bold text-white">{{ \Carbon\Carbon::parse($flight->departure_date_time)->format('H:i') }}</p>
                                <p class="text-blue-400 text-sm font-semibold">{{ $flight->route->origin_airport }}</p>
                                <p class="text-gray-400 text-xs">{{ $flight->route->origin_city }}</p>
                            </div>
                            <div class="flex flex-col items-center gap-1 flex-1">
                                <div class="flex items-center gap-1 w-full">
                                    <div class="w-2 h-2 rounded-full bg-blue-500 flex-shrink-0"></div>
                                    <div class="flex-1 h-px bg-gray-600"></div>
                                    <svg class="w-4 h-4 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    <div class="flex-1 h-px bg-gray-600"></div>
                                    <div class="w-2 h-2 rounded-full bg-gray-500 flex-shrink-0"></div>
                                </div>
                                <p class="text-gray-500 text-xs">{{ $flight->route->estimated_duration }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xl font-bold text-white">{{ \Carbon\Carbon::parse($flight->arrival_date_time)->format('H:i') }}</p>
                                <p class="text-gray-400 text-sm font-semibold">{{ $flight->route->destination_airport }}</p>
                                <p class="text-gray-400 text-xs">{{ $flight->route->destination_city }}</p>
                            </div>
                        </div>

                        {{-- Detalles --}}
                        <div class="grid grid-cols-3 gap-3 py-4 border-t border-b border-gray-700 mb-4">
                            <div>
                                <p class="text-gray-400 text-xs mb-0.5">Avión</p>
                                <p class="text-white text-sm font-medium">{{ $flight->airplane->model }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-xs mb-0.5">Salida</p>
                                <p class="text-white text-sm font-medium">{{ \Carbon\Carbon::parse($flight->departure_date_time)->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-xs mb-0.5">Tarifa base</p>
                                <p class="text-white text-sm font-bold">${{ number_format($flight->base_rate, 2) }}</p>
                            </div>
                        </div>

                        {{-- Acciones --}}
                        <div class="flex gap-2">
                            <a href="{{ route('flights.edit', $flight->id_flights) }}"
                                class="flex-1 bg-gray-700 hover:bg-gray-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition text-center">
                                Editar
                            </a>
                            <form method="POST" action="{{ route('flights.destroy', $flight->id_flights) }}" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('¿Eliminar este vuelo?')"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                                    Eliminar
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>