<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reclamos</title>
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

        {{-- Header --}}
        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-white">Reclamos</h1>
                <p class="text-gray-400 mt-1">Gestión y seguimiento de reclamos registrados</p>
            </div>
        </div>

        {{-- Alertas --}}
        @if(session('success'))
            <div class="bg-green-900 border border-green-700 text-green-300 px-4 py-3 rounded-lg mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Filtro --}}
        <div class="bg-gray-800 border border-gray-700 rounded-2xl p-5 mb-6">
            <form method="GET" action="{{ route('claims.index') }}">
                <label class="block text-sm font-medium text-gray-300 mb-1.5">Filtrar por estado</label>

                <select name="state" onchange="this.form.submit()"
                    class="w-full sm:w-72 bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Todos</option>
                    <option value="Abierto" {{ request('state') == 'Abierto' ? 'selected' : '' }}>Abierto</option>
                    <option value="En revisión" {{ request('state') == 'En revisión' ? 'selected' : '' }}>En revisión</option>
                    <option value="Resuelto" {{ request('state') == 'Resuelto' ? 'selected' : '' }}>Resuelto</option>
                </select>
            </form>
        </div>

        {{-- Lista --}}
        @if($claims->isEmpty())
            <div class="text-center py-20">
                <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h7l5 5v9a2 2 0 01-2 2z"/>
                </svg>

                <p class="text-gray-400 text-lg">No hay reclamos registrados.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($claims as $claim)
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6">

                        {{-- Header card --}}
                        <div class="flex items-start justify-between gap-4 mb-4">
                            <div>
                                <p class="text-white font-bold text-lg">{{ $claim->title }}</p>
                                <p class="text-gray-400 text-sm">{{ $claim->type }}</p>
                            </div>

                            <span class="text-xs font-semibold px-3 py-1 rounded-full
                                @if($claim->state === 'Abierto') bg-red-900 text-red-300
                                @elseif($claim->state === 'En revisión') bg-yellow-900 text-yellow-300
                                @elseif($claim->state === 'Resuelto') bg-green-900 text-green-300
                                @else bg-gray-700 text-gray-300
                                @endif">
                                {{ $claim->state }}
                            </span>
                        </div>

                        {{-- Descripción --}}
                        <div class="mb-4">
                            <p class="text-gray-400 text-xs mb-1">Descripción</p>
                            <p class="text-gray-300 text-sm leading-relaxed">
                                {{ $claim->description }}
                            </p>
                        </div>

                        {{-- Detalles --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 py-4 border-t border-b border-gray-700 mb-4">
                            <div>
                                <p class="text-gray-400 text-xs mb-0.5">Aerolínea</p>
                                <p class="text-white text-sm font-medium">{{ $claim->reserve->flight->airline->name }}</p>
                            </div>

                            <div>
                                <p class="text-gray-400 text-xs mb-0.5">Vuelo</p>
                                <p class="text-white text-sm font-medium">{{ $claim->reserve->flight->flight_number }}</p>
                            </div>

                            <div>
                                <p class="text-gray-400 text-xs mb-0.5">Ruta</p>
                                <p class="text-white text-sm font-medium">
                                    {{ $claim->reserve->flight->route->origin_city }} → {{ $claim->reserve->flight->route->destination_city }}
                                </p>
                            </div>

                            <div>
                                <p class="text-gray-400 text-xs mb-0.5">Fecha</p>
                                <p class="text-white text-sm font-medium">{{ $claim->creation_date }}</p>
                            </div>
                        </div>

                        {{-- Actualizar estado --}}
                        <form method="POST" action="{{ route('claims.updateState', $claim->id_claims) }}"
                            class="flex flex-col sm:flex-row gap-3 pt-2">
                            @csrf
                            @method('PATCH')

                            <select name="state"
                                class="flex-1 bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Abierto" {{ $claim->state == 'Abierto' ? 'selected' : '' }}>Abierto</option>
                                <option value="En revisión" {{ $claim->state == 'En revisión' ? 'selected' : '' }}>En revisión</option>
                                <option value="Resuelto" {{ $claim->state == 'Resuelto' ? 'selected' : '' }}>Resuelto</option>
                            </select>

                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition">
                                Actualizar Estado
                            </button>
                        </form>

                    </div>
                @endforeach
            </div>
        @endif

    </div>

</body>
</html>