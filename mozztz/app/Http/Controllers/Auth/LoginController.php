<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function show_login_view(){
        return view('auth/login');
    }

    public function login(Request $request)
    {
        // Валидация данных
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Попытка аутентификации пользователя
        if (Auth::attempt($credentials)) {
            // Аутентификация успешна
            return redirect()->intended('/'); // Перенаправление на защищенную страницу или на главную
        } else {
            // Неверные учетные данные
            return back()->withErrors(['username' => 'Invalid username or password.'])->withInput();
        }
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
