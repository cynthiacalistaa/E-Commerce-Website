<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\User;

class UsersController extends Controller
{
    public function home()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        User::create($request->all());
    }
    
}
