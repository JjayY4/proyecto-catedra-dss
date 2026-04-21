<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mis Reservas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-gray-800 border-b border-gray-700 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
            </svg>
            <span class="text-xl font-bold text-white">AeroProject</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('index') }}" class="text-gray-400 hover:text-white text-sm transition">Buscar Vuelos</a>
            <a href="{{ route('claims.my') }}" class="text-gray-400 hover:text-white text-sm transition">Mis Reclamos</a>
            <a href="{{ route('profile') }}" class="text-gray-400 hover:text-white text-sm transition">Mi Perfil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-lg transition">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-6 py-10">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">Mis Reservas</h1>
            <p class="text-gray-400 mt-1">Historial de tus reservas de vuelo</p>
        </div>

        {{-- Alertas --}}
        @if(session('success'))
            <div class="bg-green-900 border border-green-700 text-green-300 px-4 py-3 rounded-lg mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-900 border border-red-700 text-red-300 px-4 py-3 rounded-lg mb-6 text-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Reservas --}}
        @if($reserves->isEmpty())
            <div class="text-center py-20">
                <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="text-gray-400 text-lg">No tenés reservas aún.</p>
                <a href="{{ route('index') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition">
                    Buscar Vuelos
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($reserves as $reserve)
                    <div class="bg-gray-800 border rounded-2xl p-6
                        {{ $reserve->state_reserve === 'Cancelada' ? 'border-red-800 opacity-75' : 'border-gray-700' }}">

                        {{-- Header de la reserva --}}
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-gray-400 text-xs mb-1">Código de reserva</p>
                                <p class="text-white font-bold text-lg tracking-widest">{{ $reserve->reserve_code }}</p>
                            </div>
                            <span class="text-xs font-semibold px-3 py-1 rounded-full
                                @if($reserve->state_reserve === 'Confirmada') bg-green-900 text-green-300
                                @elseif($reserve->state_reserve === 'Cancelada') bg-red-900 text-red-300
                                @else bg-yellow-900 text-yellow-300
                                @endif">
                                {{ $reserve->state_reserve }}
                            </span>
                        </div>

                        {{-- Info del vuelo --}}
                        <div class="flex items-center gap-6 mb-4">
                            <div class="text-center">
                                <p class="text-2xl font-bold text-white">{{ \Carbon\Carbon::parse($reserve->flight->departure_date_time)->format('H:i') }}</p>
                                <p class="text-blue-400 text-sm font-semibold">{{ $reserve->flight->route->origin_airport }}</p>
                                <p class="text-gray-400 text-xs">{{ $reserve->flight->route->origin_city }}</p>
                            </div>

                            <div class="flex flex-col items-center gap-1 flex-1">
                                <div class="flex items-center gap-1 w-full">
                                    <div class="w-2 h-2 rounded-full bg-blue-500 flex-shrink-0"></div>
                                    <div class="flex-1 h-px bg-gray-600"></div>
                                    <svg class="w-4 h-4 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    <div class="flex-1 h-px bg-gray-600"></div>
                                    <div class="w-2 h-2 rounded-full bg-gray-500 flex-shrink-0"></div>
                                </div>
                                <p class="text-gray-500 text-xs">{{ $reserve->flight->flight_number }}</p>
                            </div>

                            <div class="text-center">
                                <p class="text-2xl font-bold text-white">{{ \Carbon\Carbon::parse($reserve->flight->arrival_date_time)->format('H:i') }}</p>
                                <p class="text-gray-400 text-sm font-semibold">{{ $reserve->flight->route->destination_airport }}</p>
                                <p class="text-gray-400 text-xs">{{ $reserve->flight->route->destination_city }}</p>
                            </div>
                        </div>

                        {{-- Detalles --}}
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 py-4 border-t border-gray-700 mb-4">
                            <div>
                                <p class="text-gray-400 text-xs mb-0.5">Fecha de salida</p>
                                <p class="text-white text-sm font-medium">{{ \Carbon\Carbon::parse($reserve->flight->departure_date_time)->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-xs mb-0.5">Aerolínea</p>
                                <p class="text-white text-sm font-medium">{{ $reserve->flight->airline->name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-xs mb-0.5">Total pagado</p>
                                <p class="text-white text-sm font-bold">${{ number_format($reserve->total_price, 2) }}</p>
                            </div>
                        </div>

                        {{-- Acciones --}}
                        @if($reserve->state_reserve !== 'Cancelada')
                            <div class="flex flex-wrap gap-3">
                                @if($reserve->claims->isEmpty())
                                    <a href="{{ route('claims.create', $reserve->id_reserves) }}"
                                        class="bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                                        Hacer Reclamo
                                    </a>
                                @else
                                    <span class="text-yellow-400 text-sm flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                                        </svg>
                                        Reclamo enviado
                                    </span>
                                @endif

                                @if(now()->lessThan($reserve->flight->departure_date_time))
                                    <form id="cancel-form-{{ $reserve->id_reserves }}" method="POST" action="{{ route('reserves.cancel', $reserve->id_reserves) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button
                                            type="button"
                                            onclick="openCancelModal('{{ $reserve->id_reserves }}', '{{ $reserve->reserve_code }}')"
                                            class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                                            Cancelar Reserva
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500 text-sm flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        El vuelo ya salió
                                    </span>
                                @endif
                            </div>
                        @else
                            <p class="text-red-400 text-sm flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Reserva cancelada
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                <a href="{{ route('index') }}" class="bg-gray-700 hover:bg-gray-600 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition">
                    Buscar más vuelos
                </a>
            </div>
        @endif
    </div>

    {{-- Modal cancelar reserva --}}
    <div id="cancelModal" class="fixed inset-0 z-50 hidden items-center justify-center px-4">
        <div class="absolute inset-0 bg-black/60" onclick="closeCancelModal()"></div>

        <div class="relative w-full max-w-md bg-gray-800 border border-gray-700 rounded-2xl shadow-2xl p-6">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-red-900/40 border border-red-700">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>

                <div class="flex-1">
                    <h2 class="text-xl font-bold text-white">Cancelar reserva</h2>
                    <p class="text-sm text-gray-400 mt-2">
                        Estás a punto de cancelar la reserva
                        <span id="modalReserveCode" class="text-white font-semibold"></span>.
                    </p>
                    <p class="text-sm text-gray-400 mt-2">
                        Esta acción no se puede deshacer.
                    </p>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button
                    type="button"
                    onclick="closeCancelModal()"
                    class="bg-gray-700 hover:bg-gray-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    Volver
                </button>

                <button
                    type="button"
                    id="confirmCancelBtn"
                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    Sí, cancelar
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentCancelFormId = null;

        function openCancelModal(reserveId, reserveCode) {
            currentCancelFormId = `cancel-form-${reserveId}`;

            document.getElementById('modalReserveCode').textContent = reserveCode;

            const modal = document.getElementById('cancelModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.body.classList.add('overflow-hidden');
        }

        function closeCancelModal() {
            const modal = document.getElementById('cancelModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');
            currentCancelFormId = null;
        }

        document.getElementById('confirmCancelBtn').addEventListener('click', function () {
            if (currentCancelFormId) {
                document.getElementById(currentCancelFormId).submit();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeCancelModal();
            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>