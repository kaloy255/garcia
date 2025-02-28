<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginSessionController extends Controller
{
    public function create(){
        return view('auth.login');  
    }

    public function store(Request $request){
        $loginValidateData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(! Auth::attempt($loginValidateData)){
            throw ValidationException::withMessages([
                'email'=> 'Sorry those credentials do not match.'
            ]);
        }

        request()->session()->regenerate();
        

       return redirect('/');

    }

    public function destroy(){
        Auth::logout(); 
        return redirect('/login');
    }
}
