<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Avión</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-900 text-white min-h-screen">

    <div class="max-w-2xl mx-auto px-6 py-10">

        <div class="mb-8">
            <a href="{{ route('airplanes.index') }}"
                class="text-gray-400 hover:text-white text-sm flex items-center gap-1 mb-4 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver a aviones
            </a>

            <h1 class="text-3xl font-bold text-white">Editar Avión</h1>
            <p class="text-gray-400 mt-1">Actualice los datos del avión seleccionado</p>
        </div>

        @if($errors->any())
            <div class="bg-red-900 border border-red-700 text-red-300 px-4 py-3 rounded-lg mb-6 text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="bg-gray-800 border border-gray-700 rounded-2xl p-8">
            <form method="POST" action="{{ route('airplanes.update', $airplane->id_airplanes) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Aerolínea</label>
                    <select name="id_airlines" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Seleccione una aerolínea</option>
                        @foreach($airlines as $airline)
                            <option value="{{ $airline->id_airlines }}" {{ old('id_airlines', $airplane->id_airlines) == $airline->id_airlines ? 'selected' : '' }}>
                                {{ $airline->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_airlines')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Modelo</label>
                    <input type="text" name="model" value="{{ old('model', $airplane->model) }}" required
                        placeholder="Ej: Boeing 737"
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400">
                    @error('model')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Tipo</label>
                    <select name="type" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Seleccione un tipo</option>
                        <option value="narrowbody" {{ old('type', $airplane->type) == 'narrowbody' ? 'selected' : '' }}>Narrowbody</option>
                        <option value="widebody" {{ old('type', $airplane->type) == 'widebody' ? 'selected' : '' }}>Widebody</option>
                        <option value="regional" {{ old('type', $airplane->type) == 'regional' ? 'selected' : '' }}>Regional</option>
                    </select>
                    @error('type')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Capacidad Total</label>
                    <input type="number" name="total_capacity" value="{{ old('total_capacity', $airplane->total_capacity) }}" min="1" max="853" required
                        class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('total_capacity')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Imagen actual --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">Imagen actual</label>

                    @if($airplane->image_url)
                        <div class="flex items-center gap-4 bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 mb-3">
                            <img src="{{ $airplane->image_url }}"
                                alt="Imagen {{ $airplane->model }}"
                                class="w-14 h-14 rounded-lg object-cover">

                            <div>
                                <p class="text-white text-sm font-medium">{{ $airplane->model }}</p>
                                <p class="text-gray-400 text-xs">Imagen registrada actualmente</p>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500 text-sm mb-3">Sin imagen registrada</p>
                    @endif

                    {{-- Cambiar imagen --}}
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">
                        Cambiar imagen <span class="text-gray-500">(opcional)</span>
                    </label>

                    <div class="border-2 border-dashed border-gray-600 rounded-lg p-5 text-center hover:border-blue-500 transition cursor-pointer"
                        onclick="document.getElementById('image').click()">

                        <svg class="w-8 h-8 text-gray-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>

                        <p class="text-gray-400 text-sm" id="file-label">Subir nueva imagen</p>
                        <p class="text-gray-500 text-xs mt-1">PNG, JPG, WEBP</p>

                        <input type="file" id="image" name="image" accept="image/*" class="hidden"
                            onchange="document.getElementById('file-label').textContent = this.files[0]?.name ?? 'Subir nueva imagen'">
                    </div>

                    @error('image')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botones --}}
                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition text-sm">
                        Guardar Cambios
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