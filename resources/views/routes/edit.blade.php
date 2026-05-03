<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Ruta</title>
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

    <div class="max-w-2xl mx-auto px-6 py-10">

        {{-- Header --}}
        <div class="mb-8">
            <a href="{{ route('routes.index') }}"
                class="text-gray-400 hover:text-white text-sm flex items-center gap-1 mb-4 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver a rutas
            </a>

            <h1 class="text-3xl font-bold text-white">Editar Ruta</h1>
            <p class="text-gray-400 mt-1">Actualice los datos de la ruta seleccionada</p>
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
            <form method="POST" action="{{ route('routes.update', $route->id_routes) }}" class="space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">
                        Aeropuerto de Origen
                    </label>
                    <input type="text" name="origin_airport"
                        value="{{ old('origin_airport', $route->origin_airport) }}"
                        maxlength="3" placeholder="Ej: SAL" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 uppercase">
                    @error('origin_airport')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">
                        Ciudad de Origen
                    </label>
                    <input type="text" name="origin_city"
                        value="{{ old('origin_city', $route->origin_city) }}"
                        placeholder="Ej: San Salvador" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400">
                    @error('origin_city')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">
                        Aeropuerto de Destino
                    </label>
                    <input type="text" name="destination_airport"
                        value="{{ old('destination_airport', $route->destination_airport) }}"
                        maxlength="3" placeholder="Ej: MIA" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 uppercase">
                    @error('destination_airport')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">
                        Ciudad de Destino
                    </label>
                    <input type="text" name="destination_city"
                        value="{{ old('destination_city', $route->destination_city) }}"
                        placeholder="Ej: Miami" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400">
                    @error('destination_city')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">
                            Distancia Km
                        </label>
                        <input type="number" name="distance_km"
                            value="{{ old('distance_km', $route->distance_km) }}"
                            min="1" step="0.01" required
                            class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('distance_km')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">
                            Duración Estimada
                        </label>
                        <input type="time" name="estimated_duration"
                            value="{{ old('estimated_duration', $route->estimated_duration) }}"
                            required
                            class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('estimated_duration')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition text-sm">
                        Guardar Cambios
                    </button>

                    <a href="{{ route('routes.index') }}"
                        class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2.5 rounded-lg transition text-sm text-center">
                        Cancelar
                    </a>
                </div>

            </form>
        </div>

    </div>

</body>
</html>