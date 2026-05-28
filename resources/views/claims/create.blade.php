<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hacer Reclamo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white min-h-screen">

    {{-- Navegación --}}
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
                       class="flex h-11 w-11 items-center justify-center rounded-xl border border-gray-700 bg-gray-800 text-gray-300 hover:text-white hover:border-blue-500/40 hover:bg-gray-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
                        </svg>
                    </a>

                    <a href="{{ route('profile') }}"
                       class="flex h-11 w-11 items-center justify-center rounded-xl border border-gray-700 bg-gray-800 text-gray-300 hover:text-white hover:border-blue-500/40 hover:bg-gray-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A10.97 10.97 0 0112 15.5c2.5 0 4.804.835 6.879 2.304M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="flex h-11 w-11 items-center justify-center rounded-xl border border-red-500/20 bg-red-600/10 text-red-400 hover:bg-red-600 hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H9m4 8H7a2 2 0 01-2-2V6a2 2 0 012-2h6"/>
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
            <a href="{{ route('reserves.my') }}" class="text-gray-400 hover:text-white text-sm flex items-center gap-1 mb-4 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver a mis reservas
            </a>
            <h1 class="text-3xl font-bold text-white">Generar Reclamo</h1>
            <p class="text-gray-400 mt-1">Detallá el inconveniente que tuviste con tu vuelo</p>
        </div>

        {{-- Info del vuelo (Tarjeta) --}}
        <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-5 mb-6">
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <p class="text-gray-400 text-xs mb-1">Reserva</p>
                    <p class="text-white font-medium">{{ $reserve->reserve_code }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs mb-1">Vuelo</p>
                    <p class="text-white font-medium">{{ $reserve->flight->flight_number }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs mb-1">Ruta</p>
                    <p class="text-white font-medium truncate" title="{{ $reserve->flight->route->origin_city }} → {{ $reserve->flight->route->destination_city }}">
                        {{ substr($reserve->flight->route->origin_city, 0, 3) }} → {{ substr($reserve->flight->route->destination_city, 0, 3) }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Errores Generales --}}
        @if($errors->any())
            <div class="bg-red-900/50 border border-red-700 text-red-300 px-4 py-3 rounded-lg mb-6 text-sm">
                <ul class="list-disc list-inside px-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario --}}
        <div class="bg-gray-800 border border-gray-700 rounded-2xl p-8">
            <form method="POST" action="{{ route('claims.store') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="id_reserves" value="{{ $reserve->id_reserves }}">

                {{-- Título --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Título del reclamo</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        placeholder="Ej: Mi equipaje llegó roto"
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400 transition">
                    @error('title')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tipo --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Tipo de inconveniente</label>
                    <select name="type" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <option value="">Seleccioná un tipo</option>
                        <option value="Retraso de vuelo" {{ old('type') == 'Retraso de vuelo' ? 'selected' : '' }}>Retraso de vuelo</option>
                        <option value="Equipaje dañado" {{ old('type') == 'Equipaje dañado' ? 'selected' : '' }}>Equipaje dañado</option>
                        <option value="Equipaje perdido" {{ old('type') == 'Equipaje perdido' ? 'selected' : '' }}>Equipaje perdido</option>
                        <option value="Mala atención" {{ old('type') == 'Mala atención' ? 'selected' : '' }}>Mala atención</option>
                        <option value="Cobro incorrecto" {{ old('type') == 'Cobro incorrecto' ? 'selected' : '' }}>Cobro incorrecto</option>
                        <option value="Otro" {{ old('type') == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('type')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Descripción --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Descripción detallada</label>
                    <textarea name="description" rows="5" maxlength="1000" required
                        placeholder="Por favor, brindá todos los detalles posibles sobre lo ocurrido..."
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400 resize-none transition">{{ old('description') }}</textarea>
                    <p class="text-gray-500 text-xs mt-1 text-right">Mínimo 10 caracteres</p>
                    @error('description')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botones --}}
                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition text-sm">
                        Enviar Reclamo
                    </button>
                    <a href="{{ route('reserves.my') }}"
                        class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2.5 rounded-lg transition text-sm text-center">
                        Cancelar
                    </a>
                </div>

            </form>
        </div>
    </div>

</body>
</html>