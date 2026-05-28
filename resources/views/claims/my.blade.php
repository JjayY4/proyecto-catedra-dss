<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mis Reclamos</title>
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
            <h1 class="text-3xl font-bold text-white">Mis Reclamos</h1>
            <p class="text-gray-400 mt-1">Seguimiento de tus reclamos enviados</p>
        </div>

        {{-- Alerta success --}}
        @if(session('success'))
            <div class="bg-green-900 border border-green-700 text-green-300 px-4 py-3 rounded-lg mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Lista --}}
        @if($claims->isEmpty())
            <div class="text-center py-20">
                <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-gray-400 text-lg">No tenés reclamos registrados.</p>
                <a href="{{ route('reserves.my') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-2.5 rounded-lg transition">
                    Ver mis reservas
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($claims as $claim)
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6">

                        {{-- Header --}}
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-white font-semibold text-lg">{{ $claim->title }}</p>
                                <p class="text-gray-400 text-sm mt-0.5">
                                    {{ $claim->reserve->flight->route->origin_city }}
                                    <span class="text-blue-400 mx-1">→</span>
                                    {{ $claim->reserve->flight->route->destination_city }}
                                </p>
                            </div>
                            <span class="text-xs font-semibold px-3 py-1 rounded-full flex-shrink-0
                                @if($claim->state === 'Abierto') bg-yellow-900 text-yellow-300
                                @elseif($claim->state === 'En revisión') bg-blue-900 text-blue-300
                                @else bg-green-900 text-green-300
                                @endif">
                                {{ $claim->state }}
                            </span>
                        </div>

                        {{-- Tipo y fecha --}}
                        <div class="flex flex-wrap gap-3 mb-4">
                            <span class="bg-gray-700 text-gray-300 text-xs px-3 py-1 rounded-full">
                                {{ $claim->type }}
                            </span>
                            <span class="text-gray-500 text-xs flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($claim->creation_date)->format('d M Y, H:i') }}
                            </span>
                        </div>

                        {{-- Descripción --}}
                        <div class="bg-gray-700 rounded-lg px-4 py-3">
                            <p class="text-gray-300 text-sm leading-relaxed">{{ $claim->description }}</p>
                        </div>

                        @if($claim->admin_response)
                            <div class="mt-4 bg-blue-900/20 border-l-4 border-blue-500 p-4 rounded-r-lg">
                                <p class="text-blue-300 text-xs font-bold uppercase mb-1">Respuesta del Administrador:</p>
                                <p class="text-white text-sm">{{ $claim->admin_response }}</p>
                            </div>
                        @endif

                        {{-- Timeline de estado --}}
                        <div class="mt-4 pt-4 border-t border-gray-700 flex items-center gap-2">
                            <div class="flex items-center gap-1.5">
                                <div class="w-2.5 h-2.5 rounded-full {{ in_array($claim->state, ['Abierto', 'En revisión', 'Resuelto']) ? 'bg-yellow-400' : 'bg-gray-600' }}"></div>
                                <span class="text-xs {{ in_array($claim->state, ['Abierto', 'En revisión', 'Resuelto']) ? 'text-yellow-400' : 'text-gray-500' }}">Abierto</span>
                            </div>
                            <div class="flex-1 h-px {{ in_array($claim->state, ['En revisión', 'Resuelto']) ? 'bg-blue-500' : 'bg-gray-700' }}"></div>
                            <div class="flex items-center gap-1.5">
                                <div class="w-2.5 h-2.5 rounded-full {{ in_array($claim->state, ['En revisión', 'Resuelto']) ? 'bg-blue-400' : 'bg-gray-600' }}"></div>
                                <span class="text-xs {{ in_array($claim->state, ['En revisión', 'Resuelto']) ? 'text-blue-400' : 'text-gray-500' }}">En revisión</span>
                            </div>
                            <div class="flex-1 h-px {{ $claim->state === 'Resuelto' ? 'bg-green-500' : 'bg-gray-700' }}"></div>
                            <div class="flex items-center gap-1.5">
                                <div class="w-2.5 h-2.5 rounded-full {{ $claim->state === 'Resuelto' ? 'bg-green-400' : 'bg-gray-600' }}"></div>
                                <span class="text-xs {{ $claim->state === 'Resuelto' ? 'text-green-400' : 'text-gray-500' }}">Resuelto</span>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                <a href="{{ route('index') }}"
                    class="bg-gray-700 hover:bg-gray-600 text-white p-2.5 rounded-lg transition flex items-center justify-center w-fit">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
            </div>

            
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>