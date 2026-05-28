<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Vuelo</title>
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
            <p class="text-gray-400 mt-1">Complete los datos para registrar un nuevo vuelo</p>
        </div>

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

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Tripulación Asignada</label>
                    <p class="text-gray-500 text-xs mb-3">Selecciona los miembros de tripulación disponibles para este vuelo</p>
                    <div class="space-y-2 max-h-48 overflow-y-auto bg-gray-700 border border-gray-600 rounded-lg p-3">
                        @forelse($crews as $crew)
                            <label class="flex items-center gap-3 cursor-pointer hover:bg-gray-600 px-2 py-1.5 rounded-lg transition">
                                <input type="checkbox" name="crew_members[]" value="{{ $crew->id_crew_member }}"
                                    {{ in_array($crew->id_crew_member, old('crew_members', [])) ? 'checked' : '' }}
                                    class="w-4 h-4 rounded border-gray-500 bg-gray-600 text-blue-500 focus:ring-blue-500">
                                <div>
                                    <p class="text-white text-sm font-medium">{{ $crew->name }}</p>
                                    <p class="text-gray-400 text-xs">{{ $crew->post }} — {{ $crew->airline->name }}</p>
                                </div>
                            </label>
                        @empty
                            <p class="text-gray-400 text-sm text-center py-2">No hay tripulantes disponibles</p>
                        @endforelse
                    </div>
                    @error('crew_members')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Escalas</label>
                    <p class="text-gray-500 text-xs mb-3">Agrega una escala a un vuelo</p>
                    <div id="scales-container" class="space-y-2">
                        @isset($flight)
                            @foreach($flight->scales as $index => $scale)
                                <div class="grid grid-cols-1 sm:grid-cols-4 gap-3 bg-gray-700/50 p-4 rounded-xl border border-gray-600">
                                    <input type="text" name="scales[{{$index}}][city]" value="{{$scale->city_scale}}" placeholder="Ciudad" class="bg-gray-800 border border-gray-600 rounded-lg p-2 text-white text-sm" required>
                                    <input type="text" name="scales[{{$index}}][airport]" value="{{$scale->airport_scale}}" placeholder="Aeropuerto" class="bg-gray-800 border border-gray-600 rounded-lg p-2 text-white text-sm" required>
                                    <input type="time" name="scales[{{$index}}][duration]" value="{{$scale->duration}}" class="bg-gray-800 border border-gray-600 rounded-lg p-2 text-white text-sm" required>
                                    <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-300">Eliminar</button>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                    <button type="button" id="add-scale-btn" onclick="addScale()" 
                        class="w-full mt-4 flex items-center justify-center gap-2 border-2 border-dashed border-gray-600 bg-gray-800/50 hover:bg-gray-700 hover:border-gray-500 text-gray-400 hover:text-white px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200"
                        {{ isset($flight) && $flight->scales->isNotEmpty() ? 'style=display:none' : '' }}>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Agregar Escala
                    </button>
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
    <x-sweetalert />

    <script>
function addScale() {
    const container = document.getElementById('scales-container');
    const btn = document.getElementById('add-scale-btn');

    if (container.children.length >= 1) {
        alert("Solo se permite una escala por vuelo.");
        return;
    }

    const html = `
        <div class="flex flex-col sm:flex-row items-center gap-3 bg-gray-800/50 p-4 rounded-xl border border-gray-700" id="scale-item">
            <div class="w-full sm:flex-1">
                <input type="text" name="scales[0][city]" placeholder="Ciudad" 
                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 transition" required>
            </div>
            
            <div class="w-full sm:flex-1">
                <input type="text" name="scales[0][airport]" placeholder="Aeropuerto" 
                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 transition" required>
            </div>
            
            <div class="w-full sm:w-32">
                <input 
                    type="text" 
                    name="scales[0][duration]" 
                    placeholder="HH:MM"
                    pattern="^([0-9]{2}):([0-5][0-9])$"
                    title="Formato de horas y minutos (ej. 01:45)"
                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-center placeholder-gray-500" 
                    required>
            </div>
            
            <div class="w-full sm:w-auto">
                <button type="button" onclick="removeScale()" title="Eliminar escala"
                    class="w-full sm:w-auto flex items-center justify-center gap-2 bg-red-600/10 border border-red-500/20 text-red-400 hover:bg-red-600 hover:text-white px-4 py-2.5 rounded-lg text-sm transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    <span class="sm:hidden font-medium">Eliminar</span>
                </button>
            </div>
        </div>`;
            
    container.insertAdjacentHTML('beforeend', html);
    btn.style.display = 'none'; 
}

function removeScale() {
    const container = document.getElementById('scales-container');
    const btn = document.getElementById('add-scale-btn');
    
    container.innerHTML = ''; 
    btn.style.display = ''; 
}
</script>
</body>
</html>