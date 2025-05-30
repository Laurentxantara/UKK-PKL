<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration page.
     */
    public function create(): Response
    {
        return Inertia::render('RegisterPage');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (
            !DB::table('siswa')->where('email', $request->email)->exists() &&
            !DB::table('guru')->where('email', $request->email)->exists()
        ) {
            return back()->withErrors(['email' => 'Email tidak terdaftar di data siswa atau guru.'])->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (DB::table('siswa')->where('email', $request->email)->exists()) {
            $user->assignRole('siswa');
        } elseif (DB::table('guru')->where('email', $request->email)->exists()) {
            $user->assignRole('guru');
        }

        event(new Registered($user));

        Auth::login($user);

        return to_route('dashboard');
    }
}
