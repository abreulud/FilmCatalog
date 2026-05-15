<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Credenciais inválidas.',
            ], 401);
        }

        return $this->respondWithToken($token);
    }


    public function logout()
    {
        auth()->logout();

        return response()->json([
            'message' => 'Logout realizado com sucesso.',
        ]);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    private function respondWithToken(string $token): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,  // em segundos
        ]);
    }
}