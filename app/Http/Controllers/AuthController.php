<?php

namespace App\Http\Controllers;

use App\Services\ApiResponses;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        $tentativaLogin = auth()->attempt(['email' => $email, 'password' => $password]);

        if (!$tentativaLogin) {
            return ApiResponses::unauthorized();
        }

        $user = auth()->user();

        $token = $user->createToken($user->name)->plainTextToken;


        return ApiResponses::success([
            'user' => $user->nome,
            'email' => $user->email,
            'token' => $token,
        ]);

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return ApiResponses::success("Logout realizado com sucesso!");
    }
}

