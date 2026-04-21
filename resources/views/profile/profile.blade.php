<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Perfil</title>
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
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white text-sm transition">Panel de Administración</a>
            @else
                <a href="{{ route('index') }}" class="text-gray-400 hover:text-white text-sm transition">Inicio</a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-lg transition">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-6 py-10">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">Mi Perfil</h1>
        </div>

        @php $passenger = Auth::user()->passenger; @endphp

        {{-- Avatar + nombre --}}
        <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 mb-6 flex items-center gap-5">
            <div class="w-16 h-16 rounded-full bg-blue-600 flex items-center justify-center text-2xl font-bold text-white flex-shrink-0">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div>
                <p class="text-xl font-semibold text-white">{{ Auth::user()->name }}</p>
                <p class="text-gray-400 text-sm">{{ Auth::user()->email }}</p>
            </div>
        </div>

        {{-- Datos --}}
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

        {{-- Acciones --}}
        <div class="mt-6 flex gap-3">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('dashboard') }}" class="bg-gray-700 hover:bg-gray-600 text-white text-sm px-5 py-2.5 rounded-lg transition">
                    Volver al Panel de Administración
                </a>
            @else
                <a href="{{ route('index') }}" class="bg-gray-700 hover:bg-gray-600 text-white text-sm px-5 py-2.5 rounded-lg transition">
                    Volver al Inicio
                </a>
                <a href="{{ route('reserves.my') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-5 py-2.5 rounded-lg transition">
                    Mis Reservas
                </a>
            @endif
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>