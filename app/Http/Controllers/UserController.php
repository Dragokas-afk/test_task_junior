<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    //Отображение страницы логина с проверкой на авторизацию
    public function index()
    {
        if(Auth::user()) {
            return back();
        }
        return view('login');
    }
    //Функция авторизации пользователя
    public function login(Request $request) {

        $request->validate([

            'login' => 'required|string',
            'password' => 'required|string'

        ]);

        if (Auth::attempt($request->only(['login', 'password']))){
            Log::channel('daily')->info(
                'Пользователь авторизовался ' . Auth::id()
            );
            if(Auth::user()->isProvider()) {
               return redirect('/newEquipment');
            } elseif(Auth::user()->isManager()) {
                return redirect('/equipmentList');
            }

        }

        return back()->withErrors(['login' => 'Неверные данные']);
    }
    //Функция логаута пользователя
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
