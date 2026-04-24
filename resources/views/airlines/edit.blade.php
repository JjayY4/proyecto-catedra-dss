<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Aerolínea</title>
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
            <a href="{{ route('airlines.index') }}" class="text-gray-400 hover:text-white text-sm flex items-center gap-1 mb-4 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver a aerolíneas
            </a>
            <h1 class="text-3xl font-bold text-white">Editar Aerolínea</h1>
            <p class="text-gray-400 mt-1">Modificá los datos de <span class="text-blue-400 font-medium">{{ $airline->name }}</span></p>
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
            <form method="POST" action="{{ route('airlines.update', $airline->id_airlines) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Nombre de la Aerolínea</label>
                    <input type="text" name="name" value="{{ old('name', $airline->name) }}" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400">
                    @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Código IATA</label>
                    <input type="text" name="iata_code" value="{{ old('iata_code', $airline->iata_code) }}" maxlength="2" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 uppercase">
                    <p class="text-gray-500 text-xs mt-1">Exactamente 2 caracteres en mayúsculas</p>
                    @error('iata_code')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Descripción</label>
                    <textarea name="description" rows="3"
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 resize-none">{{ old('description', $airline->description) }}</textarea>
                    @error('description')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Logo actual --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Logo actual</label>
                    @if($airline->logo_url)
                        <div class="flex items-center gap-4 bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 mb-3">
                            <img src="{{ $airline->logo_url }}" alt="Logo actual" class="w-14 h-14 rounded-lg object-cover">
                            <div>
                                <p class="text-white text-sm font-medium">{{ $airline->name }}</p>
                                <p class="text-gray-400 text-xs">Logo registrado actualmente</p>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500 text-sm mb-3">Sin logo registrado</p>
                    @endif

                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Cambiar logo <span class="text-gray-500">(opcional)</span></label>
                    <div class="border-2 border-dashed border-gray-600 rounded-lg p-5 text-center hover:border-blue-500 transition cursor-pointer"
                        onclick="document.getElementById('logo').click()">
                        <svg class="w-8 h-8 text-gray-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-gray-400 text-sm" id="file-label">Subir nueva imagen</p>
                        <p class="text-gray-500 text-xs mt-1">PNG, JPG, WEBP</p>
                        <input type="file" id="logo" name="logo" accept="image/*" class="hidden"
                            onchange="document.getElementById('file-label').textContent = this.files[0]?.name ?? 'Subir nueva imagen'">
                    </div>
                    @error('logo')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition text-sm">
                        Guardar Cambios
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