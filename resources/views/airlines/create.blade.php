<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Aerolínea</title>
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
            <a href="{{ route('airlines.index') }}" class="text-gray-400 hover:text-white text-sm transition">Ver Aerolíneas</a>
            <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white text-sm transition">Panel de Administración</a>
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
            <a href="{{ route('airlines.index') }}" class="text-gray-400 hover:text-white text-sm flex items-center gap-1 mb-4 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver a aerolíneas
            </a>
            <h1 class="text-3xl font-bold text-white">Registrar Aerolínea</h1>
            <p class="text-gray-400 mt-1">Completá los datos para registrar una nueva aerolínea</p>
        </div>

        {{-- Formulario --}}
        <div class="bg-gray-800 border border-gray-700 rounded-2xl p-8">
            <form method="POST" action="{{ route('airlines.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Nombre de la Aerolínea</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        placeholder="Ej: Avianca"
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400">
                    @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Código IATA</label>
                    <input type="text" name="iata_code" value="{{ old('iata_code') }}" maxlength="2" required
                        placeholder="Ej: AV"
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 uppercase">
                    <p class="text-gray-500 text-xs mt-1">Exactamente 2 caracteres en mayúsculas</p>
                    @error('iata_code')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Descripción</label>
                    <textarea name="description" rows="3"
                        placeholder="Descripción breve de la aerolínea..."
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 resize-none">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Logo de la Aerolínea</label>
                    <div class="border-2 border-dashed border-gray-600 rounded-lg p-6 text-center hover:border-blue-500 transition cursor-pointer"
                        onclick="document.getElementById('logo').click()">
                        <svg class="w-10 h-10 text-gray-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-gray-400 text-sm" id="file-label">Hacé clic para subir una imagen</p>
                        <p class="text-gray-500 text-xs mt-1">PNG, JPG, WEBP</p>
                        <input type="file" id="logo" name="logo" accept="image/*" class="hidden"
                            onchange="document.getElementById('file-label').textContent = this.files[0]?.name ?? 'Hacé clic para subir una imagen'">
                    </div>
                    @error('logo')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition text-sm">
                        Registrar Aerolínea
                    </button>
                    <a href="{{ route('airlines.index') }}"
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