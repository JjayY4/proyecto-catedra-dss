<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name">Nombre Completo:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="email">Correo Electrónico:</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="passport_number">Número de Pasaporte:</label><br>
            <input type="text" id="passport_number" name="passport_number" value="{{ old('passport_number') }}" required autocomplete="off">
            @error('passport_number')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="birthdate">Fecha de Nacimiento:</label><br>
            <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required>
            @error('birthdate')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="phone">Teléfono:</label><br>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
            @error('phone')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password">Contraseña:</label><br>
            <input type="password" id="password" name="password" required autocomplete="new-password">
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password_confirmation">Confirmar Contraseña:</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <button type="submit">Registrarse</button>
        </div>
    </form>
</x-guest-layout>