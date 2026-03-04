<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        if ($role === 'admin') return redirect('/admin');
        if ($role === 'office') return redirect('/office');
        return redirect('/citizen');
    }
}