<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // Show register page
    public function registerForm()
    {
        return view('citizen.register');
    }

    // Register user
    public function register(Request $request)
    {
        // For now just redirect
        return redirect('/citizen/login');
    }

    // Show login page
    public function loginForm()
    {
        return view('citizen.login');
    }

    // Login user
    public function login(Request $request)
    {
        return redirect('/citizen/dashboard');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/citizen/login');
    }

}