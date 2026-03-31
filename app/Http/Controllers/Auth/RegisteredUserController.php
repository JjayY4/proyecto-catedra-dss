<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Passengers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'passport_number' => ['required', 'string', 'alpha_num', 'min:6', 'max:15', 'unique:passengers,passport_number'],
            'birthdate' => ['required', 'date', 'before:-18 years'],
            'phone' => ['required', 'string', 'regex:/^[0-9]{4}-[0-9]{4}$/', 'unique:passengers,phone'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debes ingresar un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'passport_number.required' => 'El número de pasaporte es obligatorio.',
            'passport_number.unique' => 'Este número de pasaporte ya está registrado.',
            'passport_number.alpha_num' => 'El pasaporte solo debe contener letras y números.',
            'passport_number.min' => 'El pasaporte debe tener al menos 6 caracteres.',
            'passport_number.max' => 'El pasaporte no puede tener más de 15 caracteres.',
            'birthdate.required' => 'La fecha de nacimiento es obligatoria.',
            'birthdate.date' => 'Debes ingresar una fecha válida.',
            'birthdate.before' => 'Debes tener al menos 18 años para registrarte.',
            'phone.required' => 'El número de teléfono es obligatorio.',
            'phone.regex' => 'El teléfono debe llevar el formato correcto con guión',
            'phone.unique' => 'Este número de teléfono ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        return DB::transaction(function () use ($request) {
            $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Passengers::create([
            'passport_number' => $request->passport_number,
            'birthdate' => $request->birthdate,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'user_id' => $user->id,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('index', absolute: false));

            
        });
    }
}
