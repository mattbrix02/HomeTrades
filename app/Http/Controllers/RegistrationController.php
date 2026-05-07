<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class RegistrationController extends Controller
{

    public function index()
    {
        return Inertia::render('Register/Index');
    }


    public function create()
    {
        return Inertia::render('Register/Index');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'country' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'first_name' => $attributes['first_name'],
            'last_name' => $attributes['last_name'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
            'country' => $attributes['country'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('index.index')->with(['success' => 'Registration successful.']);
    }
}
