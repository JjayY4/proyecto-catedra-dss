<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Aerolínas Registradas</title>
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

    <div class="max-w-6xl mx-auto px-6 py-10">

        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-white">Aerolíneas</h1>
                <p class="text-gray-400 mt-1">Gestión de aerolíneas registradas</p>
            </div>
            <a href="{{ route('airlines.create') }}"
                class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-3 rounded-xl transition flex items-center justify-center gap-2 shadow-lg shadow-blue-900/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Nueva Aerolínea</span>
            </a>
        </div>

        {{-- Filtro --}}
        <div class="bg-gray-800 border border-gray-700 rounded-2xl p-5 mb-6">
            <form method="GET" action="{{ route('airlines.index') }}">
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Buscar aerolínea</label>
                <div class="flex flex-col sm:flex-row gap-3">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Nombre o código IATA..."
                        class="flex-1 bg-gray-700/80 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 transition">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition">
                        Buscar
                    </button>
                    @if(request('search'))
                        <a href="{{ route('airlines.index') }}"
                            class="bg-gray-700 hover:bg-gray-600 text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition text-center">
                            Limpiar
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Lista --}}
        @if($airlines->isEmpty())
            <div class="text-center py-20">
                <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                <p class="text-gray-400 text-lg">No hay aerolíneas registradas.</p>
                <a href="{{ route('airlines.create') }}"
                    class="inline-flex items-center justify-center gap-2 mt-4 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-3 rounded-xl transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Registrar aerolínea
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($airlines as $airline)
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6">
                        <div class="flex flex-col md:flex-row gap-5">
                            <div class="w-full md:w-44 h-32 rounded-xl overflow-hidden bg-gray-700 border border-gray-700 flex-shrink-0 flex items-center justify-center">
                                @if($airline->logo_url)
                                    <img src="{{ $airline->logo_url }}" alt="Logo {{ $airline->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-white font-bold text-4xl">{{ strtoupper(substr($airline->name, 0, 1)) }}</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex items-start justify-between gap-4 mb-4">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-blue-600 w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white font-bold text-lg">{{ $airline->name }}</p>
                                            <p class="text-gray-400 text-sm">Código IATA: {{ $airline->iata_code }}</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-blue-900 text-blue-300">Aerolínea</span>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 py-4 border-t border-b border-gray-700 mb-4">
                                    <div>
                                        <p class="text-gray-400 text-xs mb-0.5">Nombre</p>
                                        <p class="text-white text-sm font-medium">{{ $airline->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-400 text-xs mb-0.5">Código IATA</p>
                                        <p class="text-white text-sm font-bold">{{ $airline->iata_code }}</p>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <p class="text-gray-400 text-xs mb-1">Descripción</p>
                                    <p class="text-gray-300 text-sm">{{ $airline->description ?? 'Sin descripción registrada.' }}</p>
                                </div>
                                <div class="flex items-center gap-2 pt-2">
                                    <a href="{{ route('airlines.edit', $airline->id_airlines) }}"
                                        class="flex-1 bg-gray-700 hover:bg-gray-600 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>
                                        <span class="hidden sm:inline">Editar</span>
                                    </a>
                                    <form id="delete-form-{{ $airline->id_airlines }}" method="POST"
                                        action="{{ route('airlines.destroy', $airline->id_airlines) }}" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="confirmDelete('{{ $airline->id_airlines }}', @js($airline->name))"
                                            class="w-full bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m3-3h4a1 1 0 011 1v2H9V5a1 1 0 011-1z"/>
                                            </svg>
                                            <span class="hidden sm:inline">Eliminar</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <x-pagination :paginator="$airlines" />
        @endif

    </div>

    <x-sweetalert />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <script>
        function confirmDelete(airlineId, airlineName) {
            Swal.fire({
                title: '¿Eliminar aerolínea?',
                html: `Estás a punto de eliminar <strong>${airlineName}</strong>. Esta acción no se puede deshacer.`,
                icon: 'warning',
                background: '#1f2937',
                color: '#fff',
                iconColor: '#ef4444',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#374151',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${airlineId}`).submit();
                }
            });
        }
    </script>

</body>
</html>