<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role;
use App\Models\Region;
use App\Models\Genre;




class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $regions = Region::orderBy('order')->get();
        $genres = Genre::orderBy('name')->get();

        if (tenant()) {
            return view(tenantView('auth.register'), compact('regions', 'genres'));
        }

        return view('tenants.default.auth.register', compact('regions', 'genres'));
    }


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $noUsersExist = User::count() === 0;

        $rules = [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'second_last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'phone_number' => 'required|string|max:15',

            'genre_id' => ['nullable', 'exists:genres,id'],
            'birth_date' => ['nullable', 'date'],
            'residence_region_id' => ['nullable', 'exists:regions,id'],
            'residence_commune_id' => ['nullable', 'exists:communes,id'],
        ];

        if (!tenant() && !$noUsersExist) {
            $rules['access_token'] = 'required|string';
        }

        $request->validate($rules);

        if (!tenant() && !$noUsersExist) {
            $submittedToken = $request->access_token;
            $currentToken = Cache::get('current_token');

            if ($submittedToken !== $currentToken) {
                return back()->withErrors(['access_token' => 'El token de acceso es incorrecto.'])->withInput();
            }

            $this->changeToken();
        }

        // Crear el rol de Super Admin si no existe
        Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'second_last_name' => $request->second_last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'genre_id' => $request->genre_id ?? null,
            'birth_date' => $request->birth_date ?? null,
            'residence_region_id' => $request->residence_region_id ?? null,
            'residence_commune_id' => $request->residence_commune_id ?? null,
        ]);


        if (!tenant()) {
            $user->assignRole('Super Admin');
        } else {
            $user->assignRole('Usuario');
        }

        Auth::login($user);

        return tenant()
            ? redirect('/')
            : redirect(RouteServiceProvider::HOME);
    }


    /**
     * Cambiar el token dinámicamente.
     */
    protected function changeToken()
    {
        // Generar un nuevo token
        $newToken = strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4)) . '-' . rand(1000, 9999);

        // Guardar el nuevo token en el cache
        Cache::put('current_token', $newToken, now()->endOfDay());
    }


    public function showRegistrationForm()
    {
        $regions = Region::orderBy('order')->get();
        return view('auth.register', compact('regions'));
    }

}
