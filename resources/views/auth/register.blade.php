<x-guest-layout>
    <h2 class="text-2xl font-bold text-white mb-2">Crear cuenta</h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nombre Completo</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                placeholder="Tu nombre">
            @error('name')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Correo Electrónico</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                placeholder="correo@ejemplo.com">
            @error('email')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="passport_number" class="block text-sm font-medium text-gray-300 mb-1">Número de Pasaporte</label>
            <input type="text" id="passport_number" name="passport_number" value="{{ old('passport_number') }}" required autocomplete="off"
                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                placeholder="A12345678">
            @error('passport_number')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="birthdate" class="block text-sm font-medium text-gray-300 mb-1">Fecha de Nacimiento</label>
                <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required
                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('birthdate')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-300 mb-1">Teléfono</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required
                    class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                    placeholder="0000-0000">
                @error('phone')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="relative">
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Contraseña</label>

            <input type="password" id="password" name="password" required autocomplete="new-password"
                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                placeholder="••••••••">

            <button type="button" onclick="togglePassword('password', 'iconPassword')"
                class="absolute right-3 top-[38px] text-gray-400 hover:text-white">
                
                <svg id="iconPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
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

        <div class="relative">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Confirmar Contraseña</label>

            <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg px-4 py-2.5 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-400"
                placeholder="••••••••">

            <button type="button" onclick="togglePassword('password_confirmation', 'iconConfirm')"
                class="absolute right-3 top-[38px] text-gray-400 hover:text-white">

                <svg id="iconConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </button>

            @error('password_confirmation')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition text-sm mt-2">
            Crear Cuenta
        </button>

        <p class="text-center text-gray-400 text-sm">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-medium">Inicia sesión</a>
        </p>
    </form>  
</x-guest-layout>

