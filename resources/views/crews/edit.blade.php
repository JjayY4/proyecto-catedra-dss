<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Tripulación</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-900 text-white min-h-screen">

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 border-b border-gray-800 bg-gray-900/95 backdrop-blur">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">

                {{-- Logo --}}
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </div>

                    <div>
                        <span class="text-xl font-bold text-white group-hover:text-blue-400 transition">
                            SkyFlow
                        </span>
                    </div>
                </a>

                {{-- Actions --}}
                <div class="flex items-center gap-2">

                    {{-- Crew --}}
                    <a href="{{ route('crews.index') }}"
                        class="flex h-11 w-11 items-center justify-center rounded-xl border border-gray-700 bg-gray-800 text-gray-300 hover:text-white hover:border-blue-500/40 hover:bg-gray-700 transition">

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5V4H2v16h5m10 0v-4a3 3 0 00-3-3H10a3 3 0 00-3 3v4m10 0H7m8-10a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </a>

                    {{-- Profile --}}
                    <a href="{{ route('profile') }}"
                        class="flex h-11 w-11 items-center justify-center rounded-xl border border-gray-700 bg-gray-800 text-gray-300 hover:text-white hover:border-blue-500/40 hover:bg-gray-700 transition">

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A10.97 10.97 0 0112 15.5c2.5 0 4.804.835 6.879 2.304M15 11a3 3 0 11-6 0 3 3 0 016 0zm6 1a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </a>

                    {{-- Logout --}}
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

    {{-- CONTENT --}}
    <div class="max-w-2xl mx-auto px-6 py-10">

        {{-- Header --}}
        <div class="mb-8">

            <a href="{{ route('crews.index') }}"
                class="text-gray-400 hover:text-white text-sm flex items-center gap-1 mb-4 transition">

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 19l-7-7 7-7"/>
                </svg>

                Volver a tripulación
            </a>

            <h1 class="text-3xl font-bold text-white">
                Editar Miembro de Tripulación
            </h1>

            <p class="text-gray-400 mt-1">
                Actualice los datos del miembro seleccionado
            </p>
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
        <div class="bg-gray-800 border border-gray-700 rounded-3xl p-8 shadow-2xl">
            <form method="POST" action="{{ route('crews.update', $crew->id_crew_member) }}" class="space-y-6">
                @csrf
                @method('PATCH')

                {{-- Aerolínea --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">
                        Aerolínea
                    </label>

                    <select name="id_airlines" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <option value="">Seleccione una aerolínea</option>

                        @foreach($airlines as $airline)
                            <option value="{{ $airline->id_airlines }}"
                                {{ old('id_airlines', $crew->id_airlines) == $airline->id_airlines ? 'selected' : '' }}>
                                {{ $airline->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('id_airlines')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nombre --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">
                        Nombre Completo
                    </label>

                    <input type="text"
                        name="name"
                        value="{{ old('name', $crew->name) }}"
                        required
                        placeholder="Ej: Carlos Martínez López"
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400">

                    @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Apodo --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">
                        Apodo <span class="text-gray-500">(opcional)</span>
                    </label>

                    <input type="text"
                        name="nickname"
                        value="{{ old('nickname', $crew->nickname) }}"
                        placeholder="Ej: Charlie"
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400">

                    @error('nickname')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Cargo --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">
                        Cargo
                    </label>

                    <select name="post" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <option value="">Seleccione un cargo</option>

                        <option value="Piloto" {{ old('post', $crew->post) == 'Piloto' ? 'selected' : '' }}>
                            Piloto
                        </option>

                        <option value="Copiloto" {{ old('post', $crew->post) == 'Copiloto' ? 'selected' : '' }}>
                            Copiloto
                        </option>

                        <option value="Auxiliar de vuelo" {{ old('post', $crew->post) == 'Auxiliar de vuelo' ? 'selected' : '' }}>
                            Auxiliar de vuelo
                        </option>

                        <option value="Técnico" {{ old('post', $crew->post) == 'Técnico' ? 'selected' : '' }}>
                            Técnico
                        </option>
                    </select>

                    @error('post')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Licencia --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">
                        Número de Licencia
                    </label>

                    <input type="text"
                        name="license_number"
                        value="{{ old('license_number', $crew->license_number) }}"
                        required
                        placeholder="Ej: ATP-12345"
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400">

                    @error('license_number')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Disponible --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-3">
                        Estado de disponibilidad
                    </label>

                    <label class="flex items-center justify-between bg-gray-700 border border-gray-600 rounded-xl px-4 py-3 cursor-pointer hover:border-blue-500 transition">

                        <div>
                            <p class="text-white text-sm font-medium">
                                Disponible para vuelos
                            </p>

                            <p class="text-gray-400 text-xs">
                                Active esta opción si el miembro puede ser asignado
                            </p>
                        </div>

                        <input type="checkbox"
                            name="available"
                            value="1"
                            {{ old('available', $crew->available) ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-gray-500 bg-gray-800 text-blue-600 focus:ring-blue-500">
                    </label>
                </div>

                {{-- Botones --}}
                <div class="flex gap-3 pt-2">

                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition text-sm shadow-lg shadow-blue-600/20">

                        Guardar Cambios
                    </button>

                    <a href="{{ route('crews.index') }}"
                        class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-semibold py-3 rounded-xl transition text-sm text-center">

                        Cancelar
                    </a>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>