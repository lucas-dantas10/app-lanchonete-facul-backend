<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    public function __invoke(Request $request): JsonResponse
    {   
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
            'remember' => 'boolean',
        ]);
        $remember = $credentials['remember'] ?? false;

        unset($credentials['remember']);

        if (!Auth::attempt($credentials, $remember)) {
            return new JsonResponse([
                'message' => 'Email ou Senha está incorreto',
            ], 422);
        }

        /** @var \App\Models\User $user * */
        $user = Auth::user();

        $token = $user->createToken('main')->plainTextToken;

        return new JsonResponse([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
