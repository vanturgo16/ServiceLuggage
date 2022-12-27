<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function store(Request $request)
    {
       //dd($request->all());
       $request->validate([
            'user_name' => 'required',
            'user_email' => 'required',
            'user_password' => 'required',
            'user_role' => 'required',
        ]);
    }
}
