<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmar Pago — SkyFlow</title>
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

    <div class="max-w-5xl mx-auto px-6 py-10">

        <a href="{{ route('index') }}" class="text-gray-400 hover:text-white text-sm flex items-center gap-1 mb-6 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Cancelar y volver
        </a>

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">Confirmar y Pagar</h1>
            <p class="text-gray-400 mt-1">Revisá tu reserva y completá el pago</p>
        </div>

        @if($errors->any())
            <div class="bg-red-900 border border-red-700 text-red-300 px-4 py-3 rounded-lg mb-6 text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- Resumen de reserva --}}
            <div class="space-y-4">
                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6">
                    <h2 class="text-lg font-bold text-white mb-4">Resumen de tu Reserva</h2>

                    <div class="flex items-center gap-4 mb-5">
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
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-white">{{ \Carbon\Carbon::parse($reserve->flight->arrival_date_time)->format('H:i') }}</p>
                            <p class="text-gray-400 text-sm font-semibold">{{ $reserve->flight->route->destination_airport }}</p>
                            <p class="text-gray-400 text-xs">{{ $reserve->flight->route->destination_city }}</p>
                        </div>
                    </div>

                    <div class="space-y-3 border-t border-gray-700 pt-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Código de reserva</span>
                            <span class="text-white font-mono font-bold tracking-widest">{{ $reserve->reserve_code }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Vuelo</span>
                            <span class="text-white font-medium">{{ $reserve->flight->flight_number }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Aerolínea</span>
                            <span class="text-white font-medium">{{ $reserve->flight->airline->name }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Fecha de salida</span>
                            <span class="text-white font-medium">{{ \Carbon\Carbon::parse($reserve->flight->departure_date_time)->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between text-sm border-t border-gray-700 pt-3 mt-1">
                            <span class="text-gray-400 font-semibold">Total a pagar</span>
                            <span class="text-blue-400 font-bold text-xl">${{ number_format($reserve->total_price, 2) }}</span>
                        </div>
                    </div>
                </div>

                {{-- Métodos de pago --}}
                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6">
                    <h2 class="text-lg font-bold text-white mb-4">Método de Pago</h2>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="payment-option flex items-center gap-3 bg-gray-700 border-2 border-gray-600 rounded-xl p-4 cursor-pointer hover:border-blue-500 transition has-[:checked]:border-blue-500 has-[:checked]:bg-blue-500/10">
                            <input type="radio" name="payment_method" value="Tarjeta de Crédito" form="payment-form" required class="hidden">
                            <div class="w-10 h-10 rounded-lg bg-blue-600/20 border border-blue-500/30 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white text-sm font-semibold">Crédito</p>
                                <p class="text-gray-400 text-xs">Tarjeta de crédito</p>
                            </div>
                        </label>

                        <label class="payment-option flex items-center gap-3 bg-gray-700 border-2 border-gray-600 rounded-xl p-4 cursor-pointer hover:border-blue-500 transition has-[:checked]:border-blue-500 has-[:checked]:bg-blue-500/10">
                            <input type="radio" name="payment_method" value="Tarjeta de Débito" form="payment-form" class="hidden">
                            <div class="w-10 h-10 rounded-lg bg-green-600/20 border border-green-500/30 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white text-sm font-semibold">Débito</p>
                                <p class="text-gray-400 text-xs">Tarjeta de débito</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Formulario de tarjeta --}}
            <div>
                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6">
                    <h2 class="text-lg font-bold text-white mb-6">Datos de la Tarjeta</h2>

                    <form method="POST" action="{{ route('payments.store') }}" id="payment-form" class="space-y-5">
                        @csrf
                        <input type="hidden" name="id_reserves" value="{{ $reserve->id_reserves }}">

                        {{-- Preview de tarjeta --}}
                        <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl p-5 mb-6 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-8 translate-x-8"></div>
                            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-8 -translate-x-8"></div>
                            <div class="relative">
                                <p class="text-blue-200 text-xs mb-4">SkyFlow Card</p>
                                <p class="text-white font-mono text-lg tracking-widest mb-4" id="card-preview-number">0000 0000 0000 0000</p>
                                <div class="flex justify-between items-end">
                                    <div>
                                        <p class="text-blue-200 text-xs">Titular</p>
                                        <p class="text-white text-sm font-semibold uppercase" id="card-preview-name">NOMBRE APELLIDO</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-blue-200 text-xs">Vence</p>
                                        <p class="text-white text-sm font-semibold" id="card-preview-expiry">MM/AA</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Nombre en la tarjeta</label>
                            <input type="text" name="card_name" id="card_name"
                                placeholder="JUAN PEREZ" maxlength="26"
                                value="{{ old('card_name') }}"
                                class="w-full bg-gray-700 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 uppercase tracking-widest">
                            @error('card_name')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Número de tarjeta</label>
                            <input type="text" name="card_number" id="card_number"
                                placeholder="0000 0000 0000 0000" maxlength="19"
                                value="{{ old('card_number') }}"
                                class="w-full bg-gray-700 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 font-mono tracking-widest">
                            @error('card_number')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1.5">Fecha de vencimiento</label>
                                <input type="text" name="card_expiry" id="card_expiry"
                                    placeholder="MM/AA" maxlength="5"
                                    value="{{ old('card_expiry') }}"
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 font-mono">
                                @error('card_expiry')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1.5">CVV</label>
                                <input type="password" name="card_cvv" id="card_cvv"
                                    placeholder="•••" maxlength="3"
                                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 font-mono">
                                @error('card_cvv')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl transition text-sm shadow-lg shadow-blue-900/30 mt-2">
                            Confirmar Pago de ${{ number_format($reserve->total_price, 2) }}
                        </button>

                        <p class="text-center text-gray-500 text-xs flex items-center justify-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Pago simulado — tus datos no se almacenan
                        </p>

                    </form>
                </div>
            </div>

        </div>
    </div>

    <x-sweetalert />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <script>
        const cardNumber = document.getElementById('card_number');
        cardNumber.addEventListener('input', () => {
            let val = cardNumber.value.replace(/\D/g, '').substring(0, 16);
            cardNumber.value = val.replace(/(.{4})/g, '$1 ').trim();
            document.getElementById('card-preview-number').textContent = cardNumber.value || '0000 0000 0000 0000';
        });

        const cardExpiry = document.getElementById('card_expiry');
        cardExpiry.addEventListener('input', () => {
            let val = cardExpiry.value.replace(/\D/g, '').substring(0, 4);
            if (val.length >= 2) val = val.substring(0, 2) + '/' + val.substring(2);
            cardExpiry.value = val;
            document.getElementById('card-preview-expiry').textContent = cardExpiry.value || 'MM/AA';
        });

        const cardName = document.getElementById('card_name');
        cardName.addEventListener('input', () => {
            cardName.value = cardName.value.toUpperCase();
            document.getElementById('card-preview-name').textContent = cardName.value || 'NOMBRE APELLIDO';
        });
    </script>

</body>
</html>
```