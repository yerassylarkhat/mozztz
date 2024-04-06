<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //

    public function show_register_view(){
        return view('auth/register');
    }

    public function register_user(Request $request){
        $request->validate([
            'username' => 'required|string|unique:users|max:20',
            'password' => 'required|string|max:10|min:3|confirmed'
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/login')->with('success', 'Registration successful. Please login.');
    }
}
