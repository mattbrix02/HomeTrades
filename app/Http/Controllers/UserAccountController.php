<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{

    public function create(){
        return inertia('UserAccount/Create');
    }

    public function store(Request $request){
        $user = User::create($request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]));

        //automatically logs new registered user
        Auth::login($user);

        return redirect()->route('listings.index')->with('success','Your account has been created!');
    }
}
