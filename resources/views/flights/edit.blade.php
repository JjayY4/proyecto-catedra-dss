<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Vuelo</title>
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
                    <span class="text-xl font-bold text-white group-hover:text-blue-400 transition">SkyFlow</span>
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

    <main class="max-w-2xl mx-auto px-6 py-10">
        <div class="mb-8">
            <a href="{{ route('flights.index') }}" class="text-gray-400 hover:text-white text-sm flex items-center gap-1 mb-4 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver a vuelos
            </a>
            <h1 class="text-3xl font-bold text-white">Editar Vuelo</h1>
            <p class="text-gray-400 mt-1">Actualize la información del vuelo seleccionado.</p>
        </div>

        {{-- Errores --}}
        @if($errors->any())
            <div class="bg-red-900 border border-red-700 text-red-300 px-4 py-3 rounded-lg mb-6 text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-8">
        <form method="POST" action="{{ route('flights.update', $flight->id_flights) }}" class="space-y-6">
            @csrf
            @method('PATCH')
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Aerolínea</label>
                <select name="id_airlines" required
                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Seleccione una aerolínea</option>
                    @foreach($airlines as $airline)
                        <option value="{{ $airline->id_airlines }}" {{ old('id_airlines', $flight->id_airlines) == $airline->id_airlines ? 'selected' : '' }}>
                            {{ $airline->name }}
                        </option>
                    @endforeach
                </select>
                @error('id_airlines')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Ruta</label>
                <select name="id_routes" required
                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Seleccione una ruta</option>
                    @foreach($routes as $route)
                        <option value="{{ $route->id_routes }}" {{ old('id_routes', $flight->id_routes) == $route->id_routes ? 'selected' : '' }}>
                            {{ $route->origin_city }} ({{ $route->origin_airport }}) → {{ $route->destination_city }} ({{ $route->destination_airport }})
                        </option>
                    @endforeach
                </select>
                @error('id_routes')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Avión</label>
                <select name="id_airplanes" required
                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Seleccione un avión</option>
                    @foreach($airplanes as $airplane)
                        <option value="{{ $airplane->id_airplanes }}" {{ old('id_airplanes', $flight->id_airplanes) == $airplane->id_airplanes ? 'selected' : '' }}>
                            {{ $airplane->model }} ({{ $airplane->total_capacity }} asientos)
                        </option>
                    @endforeach
                </select>
                @error('id_airplanes')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Número de Vuelo</label>
                <input type="text" name="flight_number" value="{{ old('flight_number', $flight->flight_number) }}" required
                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400">
                @error('flight_number')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Fecha y Hora de Salida</label>
                    <input type="datetime-local" name="departure_date_time"
                        value="{{ old('departure_date_time', date('Y-m-d\TH:i', strtotime($flight->departure_date_time))) }}" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('departure_date_time')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Fecha y Hora de Llegada</label>
                    <input type="datetime-local" name="arrival_date_time"
                        value="{{ old('arrival_date_time', date('Y-m-d\TH:i', strtotime($flight->arrival_date_time))) }}" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('arrival_date_time')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Tarifa Base ($)</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">$</span>
                    <input type="number" name="base_rate" value="{{ old('base_rate', $flight->base_rate) }}" min="1" step="0.01" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg pl-8 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400">
                </div>
                @error('base_rate')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Estado</label>
                <select name="state" required
                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="Programado" {{ old('state', $flight->state) == 'Programado' ? 'selected' : '' }}>Programado</option>
                    <option value="En vuelo" {{ old('state', $flight->state) == 'En vuelo' ? 'selected' : '' }}>En vuelo</option>
                    <option value="Aterrizado" {{ old('state', $flight->state) == 'Aterrizado' ? 'selected' : '' }}>Aterrizado</option>
                    <option value="Cancelado" {{ old('state', $flight->state) == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                    <option value="Retrasado" {{ old('state', $flight->state) == 'Retrasado' ? 'selected' : '' }}>Retrasado</option>
                </select>
                @error('state')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition text-sm">
                    Guardar Cambios
                </button>

                <a href="{{ route('flights.index') }}"
                    class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2.5 rounded-lg transition text-sm text-center">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
    </main>

</body>
</html>