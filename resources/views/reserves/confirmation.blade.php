<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reserva Confirmada — SkyFlow</title>
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

    <div class="max-w-2xl mx-auto px-6 py-16">

        {{-- Icono de éxito --}}
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-green-500/10 border border-green-500/30 mb-4">
                <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">¡Reserva Confirmada!</h1>
            <p class="text-gray-400">Tu vuelo ha sido reservado exitosamente.</p>
        </div>

        {{-- Código de reserva --}}
        <div class="bg-blue-600/10 border border-blue-500/30 rounded-2xl p-5 text-center mb-6">
            <p class="text-gray-400 text-sm mb-1">Código de reserva</p>
            <p class="text-white font-mono font-bold text-3xl tracking-widest">{{ $reserve->reserve_code }}</p>
        </div>

        {{-- Tarjeta de vuelo --}}
        <div class="bg-gray-800 border border-gray-700 rounded-2xl overflow-hidden mb-6">

            {{-- Ruta --}}
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center gap-4">
                    <div class="text-center flex-1">
                        <p class="text-3xl font-bold text-white">{{ \Carbon\Carbon::parse($reserve->flight->departure_date_time)->format('H:i') }}</p>
                        <p class="text-blue-400 font-bold text-lg">{{ $reserve->flight->route->origin_airport }}</p>
                        <p class="text-gray-400 text-sm">{{ $reserve->flight->route->origin_city }}</p>
                    </div>

                    <div class="flex flex-col items-center gap-2 flex-1">
                        <div class="flex items-center gap-1 w-full">
                            <div class="w-2 h-2 rounded-full bg-blue-500 flex-shrink-0"></div>
                            <div class="flex-1 h-px bg-gray-600"></div>
                            <svg class="w-5 h-5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            <div class="flex-1 h-px bg-gray-600"></div>
                            <div class="w-2 h-2 rounded-full bg-gray-500 flex-shrink-0"></div>
                        </div>
                        <p class="text-gray-500 text-xs">{{ $reserve->flight->route->estimated_duration }}</p>
                        <span class="bg-green-900/50 text-green-300 text-xs px-2.5 py-0.5 rounded-full border border-green-700/50">
                            {{ $reserve->state_reserve }}
                        </span>
                    </div>

                    <div class="text-center flex-1">
                        <p class="text-3xl font-bold text-white">{{ \Carbon\Carbon::parse($reserve->flight->arrival_date_time)->format('H:i') }}</p>
                        <p class="text-gray-400 font-bold text-lg">{{ $reserve->flight->route->destination_airport }}</p>
                        <p class="text-gray-400 text-sm">{{ $reserve->flight->route->destination_city }}</p>
                    </div>
                </div>
            </div>

            {{-- Detalles --}}
            <div class="grid grid-cols-2 divide-x divide-gray-700">
                <div class="p-4">
                    <p class="text-gray-500 text-xs mb-1">Vuelo</p>
                    <p class="text-white font-semibold">{{ $reserve->flight->flight_number }}</p>
                </div>
                <div class="p-4">
                    <p class="text-gray-500 text-xs mb-1">Aerolínea</p>
                    <p class="text-white font-semibold">{{ $reserve->flight->airline->name }}</p>
                </div>
                <div class="p-4 border-t border-gray-700">
                    <p class="text-gray-500 text-xs mb-1">Fecha de salida</p>
                    <p class="text-white font-semibold">{{ \Carbon\Carbon::parse($reserve->flight->departure_date_time)->format('d M Y') }}</p>
                </div>
                <div class="p-4 border-t border-gray-700">
                    <p class="text-gray-500 text-xs mb-1">Asiento</p>
                    <p class="text-white font-semibold">{{ $reserve->seat->seat_number }}
                        <span class="text-xs font-normal text-gray-400 ml-1">{{ $reserve->seat->class }}</span>
                    </p>
                </div>
            </div>

            {{-- Total --}}
            <div class="p-5 bg-gray-700/50 border-t border-gray-700 flex items-center justify-between">
                <p class="text-gray-400 text-sm font-medium">Total pagado</p>
                <p class="text-white font-bold text-2xl">${{ number_format($reserve->total_price, 2) }}</p>
            </div>

        </div>

        {{-- Acciones --}}
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('index') }}"
                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition text-sm text-center">
                Buscar más vuelos
            </a>
            <a href="{{ route('reserves.my') }}"
                class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-semibold py-3 rounded-xl transition text-sm text-center">
                Ver mis reservas
            </a>
        </div>

    </div>

    <x-sweetalert />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>