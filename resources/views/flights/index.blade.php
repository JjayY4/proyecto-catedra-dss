<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vuelos Registrados</title>
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

                    <a href="{{ route('routes.index') }}"
                        class="flex h-11 w-11 items-center justify-center rounded-xl border border-gray-700 bg-gray-800 text-gray-300 hover:text-white hover:border-blue-500/40 hover:bg-gray-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.5 19l19-7-19-7v5l13 2-13 2v5z"/>
                        </svg>
                    </a>

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


    <div class="max-w-6xl mx-auto px-6 py-10">

        {{-- Header --}}
        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-white">Vuelos</h1>
                <p class="text-gray-400 mt-1">Gestión de vuelos registrados</p>
            </div>
            <a href="{{ route('flights.create') }}"
                class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-3 rounded-xl transition flex items-center justify-center gap-2 shadow-lg shadow-blue-900/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nuevo Vuelo
            </a>
        </div>

        {{-- Filtro --}}
<div class="bg-gray-800 border border-gray-700 rounded-2xl p-5 mb-6">
    <form method="GET" action="{{ route('flights.index') }}">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            {{-- Búsqueda por número --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Número de vuelo</label>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Ej: AA-1234..."
                    class="w-full bg-gray-700/80 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 transition">
            </div>

            {{-- Filtro por aerolínea --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Aerolínea</label>
                <select name="airline"
                    class="w-full bg-gray-700/80 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="">Todas</option>
                    @foreach($airlines as $airline)
                        <option value="{{ $airline->id_airlines }}" {{ request('airline') == $airline->id_airlines ? 'selected' : '' }}>
                            {{ $airline->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filtro por estado --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Estado</label>
                <select name="state"
                    class="w-full bg-gray-700/80 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="">Todos</option>
                    <option value="Programado"  {{ request('state') == 'Programado'  ? 'selected' : '' }}>Programado</option>
                    <option value="En vuelo"    {{ request('state') == 'En vuelo'    ? 'selected' : '' }}>En vuelo</option>
                    <option value="Aterrizado"  {{ request('state') == 'Aterrizado'  ? 'selected' : '' }}>Aterrizado</option>
                    <option value="Cancelado"   {{ request('state') == 'Cancelado'   ? 'selected' : '' }}>Cancelado</option>
                </select>
            </div>

            {{-- Botones --}}
            <div class="flex items-end gap-2">
                <button type="submit"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-3 rounded-xl transition">
                    Buscar
                </button>

                @if(request()->hasAny(['search', 'airline', 'state']))
                    <a href="{{ route('flights.index') }}"
                        class="flex-1 bg-gray-700 hover:bg-gray-600 text-white text-sm font-semibold px-5 py-3 rounded-xl transition text-center">
                        Limpiar
                    </a>
                @endif
            </div>

        </div>
    </form>
</div>

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

                        @if($flight->crew->isNotEmpty())
                            <div class="mt-3 pt-3 border-t border-gray-700">
                                <p class="text-gray-400 text-xs mb-2">Tripulación asignada</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($flight->crew as $member)
                                        <span class="bg-gray-700 text-gray-300 text-xs px-2.5 py-1 rounded-full">
                                            {{ $member->name }} — {{ $member->post }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Acciones --}}
                <div class="flex items-center gap-2 pt-2">
                    <a href="{{ route('flights.edit', $flight->id_flights) }}"
                        class="flex-1 bg-gray-700 hover:bg-gray-600 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        <span class="hidden sm:inline">Editar</span>
                    </a>

                    <form id="delete-form-{{ $flight->id_flights }}" method="POST" action="{{ route('flights.destroy', $flight->id_flights) }}" class="flex-1">
                        @csrf
                        @method('DELETE')

                        <button type="button"
                            onclick="confirmDelete('{{ $flight->id_flights }}', @js($flight->name))"
                            class="w-full bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m3-3h4a1 1 0 011 1v2H9V5a1 1 0 011-1z"/>
                            </svg>
                            <span class="hidden sm:inline">Eliminar</span>
                        </button>
                    </form>
                </div>

                    </div>
                @endforeach
            </div>
        <x-pagination :paginator="$flights" />
    @endif

    </div>
    
    <x-sweetalert />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <script>
        function confirmDelete(flightId, flightName) {
            Swal.fire({
                title: '¿Eliminar vuelo?',
                html: `Estás a punto de eliminar <strong>${flightName}</strong>. Esta acción no se puede deshacer.`,
                icon: 'warning',
                background: '#1f2937',
                color: '#fff',
                iconColor: '#ef4444',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#374151',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${flightId}`).submit();
                }
            });
        }
    </script>
</body>
</html>