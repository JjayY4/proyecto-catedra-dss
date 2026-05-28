<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mis Reservas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white min-h-screen">

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

                    <a href="{{ route('claims.my') }}"
                       class="flex h-11 w-11 items-center justify-center rounded-xl border border-gray-700 bg-gray-800 text-gray-300 hover:text-white hover:border-yellow-500/40 hover:bg-gray-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
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

    <div class="max-w-4xl mx-auto px-6 py-10">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">Mis Reservas</h1>
            <p class="text-gray-400 mt-1">Historial de tus reservas de vuelo</p>
        </div>

        @foreach($reserves as $reserve)
            @if($reserve->state_reserve == 'Pendiente')
                <div class="bg-yellow-900/30 border border-yellow-700 p-4 rounded-lg mb-6">
                    <p class="text-yellow-300 text-sm">
                        <strong>¡Atención!</strong> Tenés una reserva pendiente (Código: <strong>{{ $reserve->reserve_code }}</strong>). 
                        <a href="{{ route('payments.create', $reserve->id_reserves) }}" class="underline font-bold ml-2">
                            Completar pago ahora
                        </a> antes de que expire.
                    </p>
                </div>
            @endif
        @endforeach

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
                                            onclick="confirmDelete('{{ $reserve->id_reserves }}', '{{ $reserve->reserve_code }}')"
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
        @endif
    </div>

    <x-sweetalert />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>


    <script>
        function confirmDelete(reserveId, reserveCode) {
            Swal.fire({
                title: '¿Cancelar reserva?',
                html: `Estás a punto de cancelar <strong>${reserveCode}</strong>. Esta acción no se puede deshacer.`,
                icon: 'warning',
                background: '#1f2937',
                color: '#fff',
                iconColor: '#ef4444',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#374151',
                confirmButtonText: 'Sí, cancelar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`cancel-form-${reserveId}`).submit();
                }
            });
        }
        
    </script>

</body>
</html>