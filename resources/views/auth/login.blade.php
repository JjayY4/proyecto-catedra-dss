<x-guest-layout>
    <h2 class="text-2xl font-bold text-white mb-2">Bienvenido de nuevo</h2>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Correo Electrónico</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                placeholder="correo@ejemplo.com">
            @error('email')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="relative">
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Contraseña</label>

            <input type="password" id="password" name="password" required autocomplete="current-password"
                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                placeholder="••••••••">

            <button type="button" onclick="togglePassword('password', 'iconLogin')"
                class="absolute right-3 top-[38px] text-gray-400 hover:text-white">
                
                <svg id="iconLogin" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </button>

            @error('password')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition text-sm">
            Iniciar Sesión
        </button>

        <p class="text-center text-gray-400 text-sm">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-medium">Crea una cuenta</a>
        </p>
    </form>
</x-guest-layout>

