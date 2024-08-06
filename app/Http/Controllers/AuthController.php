<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function mainPage(Request $request){
        if(Auth::check()){
            return redirect()->route("home");
        }else{
            return redirect()->route("login");
        }
    }

    public function loginPage(Request $request){
        if(Auth::check()){
            return redirect()->route("home");
        }
        return view('login');
    }
    public function login(Request $request){
        $request->validate([
            "username" => "string",
            "password" => "string",
        ]);
        $password = $request->password;
        if(Auth::attempt([
            "username" => $request->username,
            "password" => $password,
        ])){
            return redirect()->route("home");
        }
        return redirect()->back()
            ->withInput($request->only('username'))
            ->withErrors([
                'username' => 'نام کاربری و یا رمز اشتباه است.',
            ]);
    }
}
