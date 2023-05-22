<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    //TODO Normal Redirects

    public function index()
    {
        return view('login');
    }

    public function login(Request $request) {

        $request->validate([

            'login' => 'required|string',
            'password' => 'required|string'

        ]);

        if (Auth::attempt($request->only(['login', 'password']))){
            Log::channel('daily')->info(
                'Пользователь авторизовался ' . Auth::id()
            );
           return redirect('/');
        }

        return back()->withErrors(['login' => 'Неверные данные']);
    }

}
