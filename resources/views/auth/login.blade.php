<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-white">Bienvenido de nuevo</h2>
        <p class="text-sm text-gray-400 mt-1">Inicie sesión para continuar con su experiencia en SkyFlow.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div class="space-y-1.5">
            <label for="email" class="block text-sm font-medium text-gray-300">Correo Electrónico</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="correo@ejemplo.com"
                class="w-full bg-gray-700/80 border border-gray-600 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 transition"
            >
            @error('email')
                <p class="text-red-400 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1.5">
            <label for="password" class="block text-sm font-medium text-gray-300">Contraseña</label>

            <div class="relative">
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="w-full bg-gray-700/80 border border-gray-600 text-white rounded-xl px-4 py-3 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400 transition"
                >

                <button
                    type="button"
                    onclick="togglePassword('password', 'iconLogin')"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white transition"
                >
                    <svg id="iconLogin" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
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

        <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition text-sm"
        >
            Iniciar Sesión
        </button>

        <div class="pt-2 border-t border-gray-700">
            <p class="text-center text-gray-400 text-sm">
                ¿No tiene cuenta?
                <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-medium transition">
                    Cree una cuenta
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>

