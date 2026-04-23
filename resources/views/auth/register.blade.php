<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-white">Crear cuenta</h2>
        <p class="text-sm text-gray-400 mt-1">Complete sus datos para empezar a reservar vuelos en SkyFlow.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div class="space-y-1.5">
            <label for="name" class="block text-sm font-medium text-gray-300">Nombre Completo</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="Su nombre"
                class="w-full bg-gray-700/80 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 transition"
            >
            @error('name')
                <p class="text-red-400 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1.5">
            <label for="email" class="block text-sm font-medium text-gray-300">Correo Electrónico</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="username"
                placeholder="correo@ejemplo.com"
                class="w-full bg-gray-700/80 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 transition"
            >
            @error('email')
                <p class="text-red-400 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1.5">
            <label for="passport_number" class="block text-sm font-medium text-gray-300">Número de Pasaporte</label>
            <input
                type="text"
                id="passport_number"
                name="passport_number"
                value="{{ old('passport_number') }}"
                required
                autocomplete="off"
                placeholder="A12345678"
                class="w-full bg-gray-700/80 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 transition"
            >
            @error('passport_number')
                <p class="text-red-400 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label for="birthdate" class="block text-sm font-medium text-gray-300">Fecha de Nacimiento</label>
                <input
                    type="date"
                    id="birthdate"
                    name="birthdate"
                    value="{{ old('birthdate') }}"
                    required
                    class="w-full bg-gray-700/80 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                >
                @error('birthdate')
                    <p class="text-red-400 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1.5">
                <label for="phone" class="block text-sm font-medium text-gray-300">Teléfono</label>
                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone') }}"
                    required
                    placeholder="0000-0000"
                    class="w-full bg-gray-700/80 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 transition"
                >
                @error('phone')
                    <p class="text-red-400 text-xs">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="space-y-1.5">
            <label for="password" class="block text-sm font-medium text-gray-300">Contraseña</label>

            <div class="relative">
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                    class="w-full bg-gray-700/80 border border-gray-600 text-white rounded-xl px-4 py-3 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 transition"
                >

                <button
                    type="button"
                    onclick="togglePassword('password', 'iconPassword')"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white transition"
                >
                    <svg id="iconPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>

            @error('password')
                <p class="text-red-400 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1.5">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirmar Contraseña</label>

            <div class="relative">
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                    class="w-full bg-gray-700/80 border border-gray-600 text-white rounded-xl px-4 py-3 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 transition"
                >

                <button
                    type="button"
                    onclick="togglePassword('password_confirmation', 'iconConfirm')"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white transition"
                >
                    <svg id="iconConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>

            @error('password_confirmation')
                <p class="text-red-400 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition text-sm shadow-lg shadow-blue-900/20"
        >
            Crear Cuenta
        </button>

        <div class="pt-2 border-t border-gray-700">
            <p class="text-center text-gray-400 text-sm">
                ¿Ya tiene cuenta?
                <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-medium transition">
                    Inicie sesión
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>