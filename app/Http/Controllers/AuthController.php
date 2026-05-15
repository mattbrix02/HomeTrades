<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route(Auth::user()->role === 'admin' ? 'auth.admin' : 'index.index');
        }
    }


    public function create(Request $request)
    {
       return Inertia::render('Auth/Index');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->with('error', 'Invalid login credentials.');
        }

        $request->session()->regenerate();
        $user = Auth::user();

        return redirect()->intended($user->role === 'admin' ? route('auth.admin') : route('index.index'))->with(['success' => 'Login successful.']);
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index.index')->with(['success' => 'Logout successful.']);
    }

    public function admin()
    {
        $user = Auth::user();

        if (! $user || $user->role !== 'admin') {
            return redirect()->route('index.index');
        }

        $projects = \App\Models\Project::query()->latest('id')->paginate(10);

        return Inertia::render('Admin/Index', [
            'projects' => $projects,
            'user' => $user,
        ]);
    }
}
