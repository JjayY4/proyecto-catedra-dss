<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seleccionar Asiento — SkyFlow</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white min-h-screen">

    <nav class="sticky top-0 z-50 border-b border-gray-800 bg-gray-900/95 backdrop-blur">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('index') }}" class="flex items-center gap-3 group">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl border border-blue-500/20 bg-blue-600/10">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white group-hover:text-blue-400 transition">SkyFlow</span>
                </a>
                <div class="flex items-center gap-2">
                    <a href="{{ route('reserves.my') }}"
                        class="flex h-11 w-11 items-center justify-center rounded-xl border border-gray-700 bg-gray-800 text-gray-300 hover:text-white hover:border-blue-500/40 hover:bg-gray-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
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

    <div class="max-w-7xl mx-auto px-6 py-10">

        {{-- Back --}}
        <a href="{{ route('index') }}" class="text-gray-400 hover:text-white text-sm flex items-center gap-1 mb-6 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Volver a vuelos
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Columna izquierda: info vuelo + resumen --}}
            <div class="lg:col-span-1 space-y-4">

                {{-- Info del vuelo --}}
                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6">
                    <h2 class="text-lg font-bold text-white mb-4">Detalles del vuelo</h2>

                    <div class="flex items-center gap-4 mb-4">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-white">{{ \Carbon\Carbon::parse($flight->departure_date_time)->format('H:i') }}</p>
                            <p class="text-blue-400 text-sm font-semibold">{{ $flight->route->origin_airport }}</p>
                            <p class="text-gray-400 text-xs">{{ $flight->route->origin_city }}</p>
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
                            <p class="text-gray-500 text-xs">{{ $flight->route->estimated_duration }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-white">{{ \Carbon\Carbon::parse($flight->arrival_date_time)->format('H:i') }}</p>
                            <p class="text-gray-400 text-sm font-semibold">{{ $flight->route->destination_airport }}</p>
                            <p class="text-gray-400 text-xs">{{ $flight->route->destination_city }}</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-700 pt-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Vuelo</span>
                            <span class="text-white font-medium">{{ $flight->flight_number }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Aerolínea</span>
                            <span class="text-white font-medium">{{ $flight->airline->name }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Salida</span>
                            <span class="text-white font-medium">{{ \Carbon\Carbon::parse($flight->departure_date_time)->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Leyenda de precios --}}
                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6">
                    <h2 class="text-lg font-bold text-white mb-4">Tarifas por clase</h2>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-4 h-4 rounded" style="background: #EEEDFE; border: 1px solid #AFA9EC;"></div>
                                <span class="text-white text-sm font-medium">Primera</span>
                            </div>
                            <span class="text-white font-bold">${{ number_format($flight->base_rate * 2, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-4 h-4 rounded" style="background: #E1F5EE; border: 1px solid #5DCAA5;"></div>
                                <span class="text-white text-sm font-medium">Ejecutiva</span>
                            </div>
                            <span class="text-white font-bold">${{ number_format($flight->base_rate * 1.5, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-4 h-4 rounded bg-gray-600 border border-gray-500"></div>
                                <span class="text-white text-sm font-medium">Económica</span>
                            </div>
                            <span class="text-white font-bold">${{ number_format($flight->base_rate, 2) }}</span>
                        </div>
                        <div class="flex items-center gap-3 pt-1 border-t border-gray-700">
                            <div class="w-4 h-4 rounded bg-gray-700 border border-gray-600"></div>
                            <span class="text-gray-500 text-sm">Ocupado</span>
                        </div>
                    </div>
                </div>

                {{-- Resumen selección --}}
                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6" id="summary-box">
                    <h2 class="text-lg font-bold text-white mb-4">Tu selección</h2>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Asiento</span>
                            <span class="text-white font-medium" id="summary-seat">—</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Clase</span>
                            <span class="text-white font-medium" id="summary-class">—</span>
                        </div>
                        <div class="flex justify-between text-sm border-t border-gray-700 pt-2 mt-2">
                            <span class="text-gray-400">Total a pagar</span>
                            <span class="text-blue-400 font-bold text-lg" id="summary-price">—</span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Columna derecha: mapa de asientos --}}
            <div class="lg:col-span-2">
                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6">
                    <h2 class="text-lg font-bold text-white mb-6">Seleccioná tu asiento</h2>

                    @if($errors->any())
                        <div class="bg-red-900 border border-red-700 text-red-300 px-4 py-3 rounded-lg mb-6 text-sm">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('reserves.store') }}" id="reserve-form">
                        @csrf
                        <input type="hidden" name="id_flights" value="{{ $flight->id_flights }}">
                        <input type="hidden" name="id_seats" id="selected_seat_input" value="">

                        @php
                            $primeraSeats   = $seats->where('class', 'Primera');
                            $ejecutivaSeats = $seats->where('class', 'Ejecutiva');
                            $economicaSeats = $seats->where('class', 'Económica');
                        @endphp

                        {{-- Frente del avión --}}
                        <div class="flex justify-center mb-6">
                            <div class="bg-gray-700 border border-gray-600 rounded-full px-8 py-2 text-xs text-gray-400">
                                Frente del avión
                            </div>
                        </div>

                        {{-- Primera clase --}}
                        <div class="mb-6">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="h-px flex-1 bg-gray-700"></div>
                                <span class="text-xs font-semibold text-purple-400 uppercase tracking-widest">Primera clase</span>
                                <div class="h-px flex-1 bg-gray-700"></div>
                            </div>
                            <div class="flex flex-wrap gap-2 justify-center">
                                @foreach($primeraSeats as $seat)
                                    @php $ocupado = in_array($seat->id_seats, $reservedSeatIds); @endphp
                                    <button type="button"
                                        class="seat-btn w-12 h-12 rounded-lg text-xs font-bold transition-all duration-150 {{ $ocupado ? 'bg-gray-700 text-gray-500 cursor-not-allowed border border-gray-600' : 'border border-purple-400/50 cursor-pointer hover:scale-105' }}"
                                        style="{{ !$ocupado ? 'background: #EEEDFE; color: #3C3489;' : '' }}"
                                        data-id="{{ $seat->id_seats }}"
                                        data-number="{{ $seat->seat_number }}"
                                        data-class="Primera"
                                        data-price="{{ $flight->base_rate * 2 }}"
                                        {{ $ocupado ? 'disabled' : '' }}>
                                        {{ $seat->seat_number }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        {{-- Ejecutiva --}}
                        <div class="mb-6">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="h-px flex-1 bg-gray-700"></div>
                                <span class="text-xs font-semibold text-teal-400 uppercase tracking-widest">Ejecutiva</span>
                                <div class="h-px flex-1 bg-gray-700"></div>
                            </div>
                            <div class="flex flex-wrap gap-2 justify-center">
                                @foreach($ejecutivaSeats as $seat)
                                    @php $ocupado = in_array($seat->id_seats, $reservedSeatIds); @endphp
                                    <button type="button"
                                        class="seat-btn w-12 h-12 rounded-lg text-xs font-bold transition-all duration-150 {{ $ocupado ? 'bg-gray-700 text-gray-500 cursor-not-allowed border border-gray-600' : 'border border-teal-400/50 cursor-pointer hover:scale-105' }}"
                                        style="{{ !$ocupado ? 'background: #E1F5EE; color: #085041;' : '' }}"
                                        data-id="{{ $seat->id_seats }}"
                                        data-number="{{ $seat->seat_number }}"
                                        data-class="Ejecutiva"
                                        data-price="{{ $flight->base_rate * 1.5 }}"
                                        {{ $ocupado ? 'disabled' : '' }}>
                                        {{ $seat->seat_number }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        {{-- Económica --}}
                        <div class="mb-8">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="h-px flex-1 bg-gray-700"></div>
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Económica</span>
                                <div class="h-px flex-1 bg-gray-700"></div>
                            </div>
                            <div class="flex flex-wrap gap-2 justify-center">
                                @foreach($economicaSeats as $seat)
                                    @php $ocupado = in_array($seat->id_seats, $reservedSeatIds); @endphp
                                    <button type="button"
                                        class="seat-btn w-12 h-12 rounded-lg text-xs font-bold transition-all duration-150 {{ $ocupado ? 'bg-gray-700 text-gray-500 cursor-not-allowed border border-gray-600' : 'bg-gray-600 border border-gray-500 text-white cursor-pointer hover:scale-105 hover:bg-gray-500' }}"
                                        data-id="{{ $seat->id_seats }}"
                                        data-number="{{ $seat->seat_number }}"
                                        data-class="Económica"
                                        data-price="{{ $flight->base_rate }}"
                                        {{ $ocupado ? 'disabled' : '' }}>
                                        {{ $seat->seat_number }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        {{-- Cola del avión --}}
                        <div class="flex justify-center mb-6">
                            <div class="bg-gray-700 border border-gray-600 rounded-full px-8 py-2 text-xs text-gray-400">
                                Cola del avión
                            </div>
                        </div>

                        <button type="submit" id="confirm-btn" disabled
                            class="w-full bg-blue-600 hover:bg-blue-700 disabled:bg-gray-700 disabled:text-gray-500 disabled:cursor-not-allowed text-white font-semibold py-3 rounded-xl transition text-sm">
                            Confirmar Asiento y Continuar al Pago
                        </button>

                    </form>
                </div>
            </div>

        </div>
    </div>

    <x-sweetalert />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <script>
        document.querySelectorAll('.seat-btn:not([disabled])').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.seat-btn.selected').forEach(s => {
                    s.classList.remove('selected', 'ring-2', 'ring-blue-500', 'scale-110');
                });

                btn.classList.add('selected', 'ring-2', 'ring-blue-500', 'scale-110');

                document.getElementById('selected_seat_input').value = btn.dataset.id;
                document.getElementById('summary-seat').textContent = btn.dataset.number;
                document.getElementById('summary-class').textContent = btn.dataset.class;
                document.getElementById('summary-price').textContent = '$' + parseFloat(btn.dataset.price).toFixed(2);
                document.getElementById('confirm-btn').disabled = false;
            });

            document.getElementById('reserve-form').addEventListener('submit', function() {
                const confirmBtn = document.getElementById('confirm-btn');
                confirmBtn.disabled = true;
                confirmBtn.textContent = 'Procesando...';
            });
        });
    </script>

</body>
</html>