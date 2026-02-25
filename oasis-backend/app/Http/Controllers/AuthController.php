<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller 
{
    public function register(Request $request)
    {
        $request->validate([
            'Name' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|unique:users,email',
            'Password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $request->Name,
            'email' => $request->Email,
            'password'=> Hash::make($request->Password),
        ]);

        return response()->json([
            'message' => 'Користувач успішно зареєстрований!',
            'user'=> $user
        ], 201);
    }

    public function login(Request $request)
    {
        $credential = $request->validate([
            'Email' => 'required|email',
            'Password' => 'required',
        ]);

        if(!Auth::attempt([
            'email'=>$credential['Email'],
            'password'=>$credential['Password']
        ])){
            throw ValidationException::withMessages([
                'Email' => ['Невірний логін або пароль']
            ]);
        }

        $request->session()->regenerate();

        return response()->json([
            'message'=>'Вхід Успішний',
            'data'=>Auth::user(),
        ]);
    }
}