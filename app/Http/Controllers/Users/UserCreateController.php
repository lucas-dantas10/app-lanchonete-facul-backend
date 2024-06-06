<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCreateController
{
    public function __invoke(Request $request): JsonResponse
    {
        $requestValidated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email'],
            // 'school' => ['required', 'string'],
            'password' => ['required'],
        ]);

        User::createOrFirst($requestValidated);

        return new JsonResponse([
            'message' => 'Conta criada com sucesso',
        ]);
    }
}
