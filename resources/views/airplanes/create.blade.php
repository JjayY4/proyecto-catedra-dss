<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Avión</title>
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
        <a href="{{ route('airplanes.index') }}"
            class="text-gray-400 hover:text-white text-sm flex items-center gap-1 mb-4 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Volver a aviones
        </a>

        <h1 class="text-3xl font-bold text-white">Registrar Avión</h1>
        <p class="text-gray-400 mt-1">Complete los datos para registrar un nuevo avión</p>
    </div>

    {{-- Formulario --}}
    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-8">
        <form method="POST" action="{{ route('airplanes.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Aerolínea --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Aerolínea</label>
                <select name="id_airlines" required
                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
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

            {{-- Modelo --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Modelo</label>
                <input type="text" name="model" value="{{ old('model') }}" required
                    placeholder="Ej: Boeing 737"
                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400">
                @error('model')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tipo --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Tipo</label>
                <select name="type" required
                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Seleccione un tipo</option>
                    <option value="narrowbody" {{ old('type') == 'narrowbody' ? 'selected' : '' }}>Narrowbody</option>
                    <option value="widebody" {{ old('type') == 'widebody' ? 'selected' : '' }}>Widebody</option>
                    <option value="regional" {{ old('type') == 'regional' ? 'selected' : '' }}>Regional</option>
                </select>
                @error('type')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Capacidad --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Capacidad Total</label>
                <input type="number" name="total_capacity" value="{{ old('total_capacity') }}" min="1" required
                    placeholder="Ej: 180"
                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400">
                @error('total_capacity')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Descripción</label>
                <textarea name="description" rows="3"
                    placeholder="Descripción del avión..."
                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400 resize-none">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Imagen --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Imagen del avión</label>

                <div class="border-2 border-dashed border-gray-600 rounded-lg p-6 text-center hover:border-blue-500 transition cursor-pointer"
                    onclick="document.getElementById('image').click()">

                    <svg class="w-10 h-10 text-gray-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>

                    <p class="text-gray-400 text-sm" id="file-label">Subir imagen</p>
                    <p class="text-gray-500 text-xs mt-1">PNG, JPG, WEBP</p>

                    <input type="file" id="image" name="image" accept="image/*" class="hidden"
                        onchange="document.getElementById('file-label').textContent = this.files[0]?.name ?? 'Subir imagen'">
                </div>

                @error('image')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Botones --}}
            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition text-sm">
                    Registrar Avión
                </button>

                <a href="{{ route('airplanes.index') }}"
                    class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2.5 rounded-lg transition text-sm text-center">
                    Cancelar
                </a>
            </div>

        </form>
    </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

        <x-sweetalert />

</body>
</html>