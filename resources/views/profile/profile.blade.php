<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Perfil</title>
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
                        <span class="text-xl font-bold text-white group-hover:text-blue-400 transition">SkyFlow</span>
                    </div>
                </a>

                <div class="flex items-center gap-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex h-11 w-11 items-center justify-center rounded-xl border border-red-500/20 bg-red-600/10 text-red-400 hover:bg-red-600 hover:text-white transition" title="Cerrar sesión">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H9m4 8H7a2 2 0 01-2-2V6a2 2 0 012-2h6"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-6 py-10">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">Mi Perfil</h1>
        </div>

        @php
            $passenger = Auth::user()->passenger;
        @endphp

        <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 mb-6 flex items-center gap-5">
            <div class="w-16 h-16 rounded-full bg-blue-600 flex items-center justify-center text-2xl font-bold text-white flex-shrink-0">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div>
                <p class="text-xl font-semibold text-white">{{ Auth::user()->name }}</p>
                <p class="text-gray-400 text-sm">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 space-y-5">
            <h2 class="text-lg font-semibold text-white border-b border-gray-700 pb-3">Información Personal</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <p class="text-gray-400 text-xs mb-1">Nombre Completo</p>
                    <p class="text-white font-medium">{{ Auth::user()->name }}</p>
                </div>

                <div>
                    <p class="text-gray-400 text-xs mb-1">Correo Electrónico</p>
                    <p class="text-white font-medium">{{ Auth::user()->email }}</p>
                </div>

                <div>
                    <p class="text-gray-400 text-xs mb-1">Fecha de Nacimiento</p>
                    <p class="text-white font-medium">{{ $passenger->birthdate ?? 'No registrado' }}</p>
                </div>

                <div>
                    <p class="text-gray-400 text-xs mb-1">Teléfono</p>
                    <p class="text-white font-medium">{{ $passenger->phone ?? 'No registrado' }}</p>
                </div>

                <div class="md:col-span-2">
                    <p class="text-gray-400 text-xs mb-1">Número de Pasaporte</p>
                    <p class="text-white font-medium">{{ $passenger->passport_number ?? 'No registrado' }}</p>
                </div>
            </div>
        </div>

        <div class="mt-6 flex">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('dashboard') }}" class="bg-gray-700 hover:bg-gray-600 text-white p-2.5 rounded-lg transition flex items-center justify-center" title="Volver al panel">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
            @else
                <a href="{{ route('index') }}" class="bg-gray-700 hover:bg-gray-600 text-white p-2.5 rounded-lg transition flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
            @endif
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>