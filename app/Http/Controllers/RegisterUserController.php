<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(){
        $validateFormData = request()->validate([
           'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|max:255'
        ]);
        

        $user = User::create($validateFormData);

        Auth::login($user);

        // Redirect based on user role
        if($user->role === 'admin') {
            return redirect('/admin')->with('success', 'Registration successful! Welcome to admin dashboard.');
        }

        return redirect('/')->with('success', 'Registration successful!');
    }
}
