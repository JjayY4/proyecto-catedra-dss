<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tripulación</title>
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

                    <a href="{{ route('crews.index') }}"
                        class="flex h-11 w-11 items-center justify-center rounded-xl border border-gray-700 bg-gray-800 text-gray-300 hover:text-white hover:border-blue-500/40 hover:bg-gray-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-1a4 4 0 00-3-3.87M9 20H4v-1a4 4 0 013-3.87m10-4a4 4 0 11-8 0 4 4 0 018 0zM5 11a4 4 0 118 0 4 4 0 01-8 0z"/>
                        </svg>
                    </a>

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
                <h1 class="text-3xl sm:text-4xl font-bold text-white">Tripulación</h1>
                <p class="text-gray-400 mt-1">Gestión de miembros registrados</p>
            </div>

            <a href="{{ route('crews.create') }}"
                class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-3 rounded-xl transition flex items-center justify-center gap-2 shadow-lg shadow-blue-900/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nuevo Miembro
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-900 border border-green-700 text-green-300 px-4 py-3 rounded-lg mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if($crews->isEmpty())
            <div class="text-center py-20">
                <p class="text-gray-400 text-lg">No hay miembros registrados.</p>

                <a href="{{ route('crews.create') }}"
                    class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition">
                    Registrar primer miembro
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($crews as $crew)
                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6">

                    <div class="flex flex-col md:flex-row gap-5">

                        {{-- Avatar --}}
                        <div class="w-full md:w-44 h-32 rounded-xl overflow-hidden bg-gray-700 border border-gray-700 flex-shrink-0 flex items-center justify-center">
                            <span class="text-white font-bold text-5xl">
                                {{ strtoupper(substr($crew->name, 0, 1)) }}
                            </span>
                        </div>

                        <div class="flex-1">
                            {{-- Header --}}
                            <div class="flex items-start justify-between gap-4 mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="bg-blue-600 w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5.121 17.804A10.97 10.97 0 0112 15.5c2.5 0 4.804.835 6.879 2.304M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-white font-bold text-lg">{{ $crew->name }}</p>
                                        <p class="text-gray-400 text-sm">{{ $crew->airline->name }}</p>
                                    </div>
                                </div>

                                <span class="text-xs font-semibold px-3 py-1 rounded-full
                                    {{ $crew->available ? 'bg-green-900 text-green-300' : 'bg-red-900 text-red-300' }}">
                                    {{ $crew->available ? 'Disponible' : 'No disponible' }}
                                </span>
                            </div>

                            {{-- Detalles --}}
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 py-4 border-t border-b border-gray-700 mb-4">
                                <div>
                                    <p class="text-gray-400 text-xs mb-0.5">Cargo</p>
                                    <p class="text-white text-sm font-medium">{{ $crew->post }}</p>
                                </div>

                                <div>
                                    <p class="text-gray-400 text-xs mb-0.5">Apodo</p>
                                    <p class="text-white text-sm font-medium">{{ $crew->nickname ?? 'N/A' }}</p>
                                </div>

                                <div>
                                    <p class="text-gray-400 text-xs mb-0.5">Licencia</p>
                                    <p class="text-white text-sm font-bold">{{ $crew->license_number }}</p>
                                </div>
                            </div>

                            {{-- Acciones --}}
                            <div class="flex items-center gap-2 pt-2">
                                <a href="{{ route('crews.edit', $crew->id_crew_member) }}"
                                    class="flex-1 bg-gray-700 hover:bg-gray-600 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition text-center">
                                    Editar
                                </a>

                                <form id="delete-form-{{ $crew->id_crew_member }}" method="POST" action="{{ route('crews.destroy', $crew->id_crew_member) }}" class="flex-1">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                        onclick="openDeleteModal('{{ $crew->id_crew_member }}', @js($crew->name))"
                                        class="w-full bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>

                @endforeach
            </div>
        @endif

    </div>

    <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center px-4">
        <div class="absolute inset-0 bg-black/60" onclick="closeDeleteModal()"></div>

        <div class="relative w-full max-w-md bg-gray-800 border border-gray-700 rounded-2xl shadow-2xl p-6">
            <h2 class="text-xl font-bold text-white">Eliminar miembro</h2>

            <p class="text-sm text-gray-400 mt-2">
                Estás a punto de eliminar a
                <span id="modalCrewName" class="text-white font-semibold"></span>.
            </p>

            <p class="text-sm text-gray-400 mt-2">Esta acción no se puede deshacer.</p>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="closeDeleteModal()"
                    class="bg-gray-700 hover:bg-gray-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    Volver
                </button>

                <button type="button" id="confirmDeleteBtn"
                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    Sí, eliminar
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentDeleteFormId = null;

        function openDeleteModal(crewId, crewName) {
            currentDeleteFormId = `delete-form-${crewId}`;
            document.getElementById('modalCrewName').textContent = crewName;

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
    </script>

</body>
</html>