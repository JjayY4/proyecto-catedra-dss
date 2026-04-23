<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Aerolínas Registradas</title>
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
            <span class="ml-2 bg-blue-600 text-blue-100 text-xs font-medium px-2.5 py-0.5 rounded-full">Admin</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white text-sm transition">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-lg transition">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-6 py-10">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white">Aerolíneas</h1>
                <p class="text-gray-400 mt-1">Gestión de aerolíneas registradas</p>
            </div>
            <a href="{{ route('airlines.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva Aerolínea
            </a>
        </div>

        {{-- Alertas --}}
        @if(session('success'))
            <div class="bg-green-900 border border-green-700 text-green-300 px-4 py-3 rounded-lg mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Lista --}}
        @if($airlines->isEmpty())
            <div class="text-center py-20">
                <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                <p class="text-gray-400 text-lg">No hay aerolíneas registradas.</p>
                <a href="{{ route('airlines.create') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition">
                    Registrar primera aerolínea
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($airlines as $airline)
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 flex flex-col gap-4">

                        {{-- Logo y nombre --}}
                        <div class="flex items-center gap-4">
                            @if($airline->logo_url)
                                <img src="{{ $airline->logo_url }}" alt="Logo {{ $airline->name }}"
                                    class="w-16 h-16 rounded-xl object-cover bg-gray-700 flex-shrink-0">
                            @else
                                <div class="w-16 h-16 rounded-xl bg-blue-600 flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-bold text-xl">{{ strtoupper(substr($airline->name, 0, 1)) }}</span>
                                </div>
                            @endif
                            <div>
                                <h3 class="text-white font-semibold text-lg leading-tight">{{ $airline->name }}</h3>
                                <span class="inline-block bg-gray-700 text-gray-300 text-xs font-mono px-2.5 py-0.5 rounded-full mt-1">
                                    {{ $airline->iata_code }}
                                </span>
                            </div>
                        </div>

                        {{-- Descripción --}}
                        <p class="text-gray-400 text-sm leading-relaxed flex-1">
                            {{ $airline->description ?? 'Sin descripción registrada.' }}
                        </p>

                        {{-- Acciones --}}
                        <div class="flex gap-2 pt-2 border-t border-gray-700">
                            <a href="{{ route('airlines.edit', $airline->id_airlines) }}"
                                class="flex-1 bg-gray-700 hover:bg-gray-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition text-center">
                                Editar
                            </a>

                            <form id="delete-form-{{ $airline->id_airlines }}" method="POST" action="{{ route('airlines.destroy', $airline->id_airlines) }}" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="button"
                                    onclick="openDeleteModal('{{ $airline->id_airlines }}', @js($airline->name))"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                                    Eliminar
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>

    {{-- Modal eliminar aerolínea --}}
    <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center px-4">
        <div class="absolute inset-0 bg-black/60" onclick="closeDeleteModal()"></div>

        <div class="relative w-full max-w-md bg-gray-800 border border-gray-700 rounded-2xl shadow-2xl p-6">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-red-900/40 border border-red-700">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>

                <div class="flex-1">
                    <h2 class="text-xl font-bold text-white">Eliminar aerolínea</h2>
                    <p class="text-sm text-gray-400 mt-2">
                        Estás a punto de eliminar la aerolínea
                        <span id="modalAirlineName" class="text-white font-semibold"></span>.
                    </p>
                    <p class="text-sm text-gray-400 mt-2">
                        Esta acción no se puede deshacer.
                    </p>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button
                    type="button"
                    onclick="closeDeleteModal()"
                    class="bg-gray-700 hover:bg-gray-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    Volver
                </button>

                <button
                    type="button"
                    id="confirmDeleteBtn"
                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    Sí, eliminar
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentDeleteFormId = null;

        function openDeleteModal(airlineId, airlineName) {
            currentDeleteFormId = `delete-form-${airlineId}`;

            document.getElementById('modalAirlineName').textContent = airlineName;

            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.body.classList.add('overflow-hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');
            currentDeleteFormId = null;
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (currentDeleteFormId) {
                document.getElementById(currentDeleteFormId).submit();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>