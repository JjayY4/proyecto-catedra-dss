<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mis Reclamos</title>
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
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('index') }}" class="text-gray-400 hover:text-white text-sm transition">Buscar Vuelos</a>
            <a href="{{ route('reserves.my') }}" class="text-gray-400 hover:text-white text-sm transition">Mis Reservas</a>
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