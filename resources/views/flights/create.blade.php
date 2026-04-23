<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Vuelo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-gray-800 border-b border-gray-700 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
            </svg>
            <span class="text-xl font-bold text-white">SkyFlow</span>
            <span class="ml-2 bg-blue-600 text-blue-100 text-xs font-medium px-2.5 py-0.5 rounded-full">Administrador</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('flights.index') }}" class="text-gray-400 hover:text-white text-sm transition">Ver Vuelos</a>
            <a href="{{ route('routes.create') }}" class="text-gray-400 hover:text-white text-sm transition">Registrar Ruta</a>
            <a href="{{ route('routes.index') }}" class="text-gray-400 hover:text-white text-sm transition">Ver Rutas</a>
            <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white text-sm transition">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-lg transition">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-6 py-10">

        {{-- Header --}}
        <div class="mb-8">
            <a href="{{ route('flights.index') }}" class="text-gray-400 hover:text-white text-sm flex items-center gap-1 mb-4 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver a vuelos
            </a>
            <h1 class="text-3xl font-bold text-white">Registrar Vuelo</h1>
            <p class="text-gray-400 mt-1">Completá los datos para registrar un nuevo vuelo</p>
        </div>

        {{-- Errores --}}
        @if($errors->any())
            <div class="bg-red-900 border border-red-700 text-red-300 px-4 py-3 rounded-lg mb-6 text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Formulario --}}
        <div class="bg-gray-800 border border-gray-700 rounded-2xl p-8">
            <form method="POST" action="{{ route('flights.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Aerolínea</label>
                    <select name="id_airlines" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Seleccione una aerolínea</option>
                        @foreach($airlines as $airline)
                            <option value="{{ $airline->id_airlines }}" {{ old('id_airlines') == $airline->id_airlines ? 'selected' : '' }}>
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
                            <option value="{{ $route->id_routes }}" {{ old('id_routes') == $route->id_routes ? 'selected' : '' }}>
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
                            <option value="{{ $airplane->id_airplanes }}" {{ old('id_airplanes') == $airplane->id_airplanes ? 'selected' : '' }}>
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
                    <input type="text" name="flight_number" value="{{ old('flight_number') }}" placeholder="Ej: AV1234" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400">
                    @error('flight_number')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Fecha y Hora de Salida</label>
                        <input type="datetime-local" name="departure_date_time" value="{{ old('departure_date_time') }}" required
                            class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('departure_date_time')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Fecha y Hora de Llegada</label>
                        <input type="datetime-local" name="arrival_date_time" value="{{ old('arrival_date_time') }}" required
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
                        <input type="number" name="base_rate" value="{{ old('base_rate') }}" min="1" step="0.01" required
                            class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg pl-8 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                            placeholder="0.00">
                    </div>
                    @error('base_rate')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition text-sm">
                        Registrar Vuelo
                    </button>
                    <a href="{{ route('flights.index') }}"
                        class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2.5 rounded-lg transition text-sm text-center">
                        Cancelar
                    </a>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>