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
            'school' => ['required', 'string'],
            'password' => ['required'],
            'is_admin' => ['boolean'],
        ]);

        $requestValidated['is_admin'] = $requestValidated['is_admin'] ?? false;

        $user = User::createOrFirst($requestValidated);

        return new JsonResponse([
            'user' => $user,
            'message' => 'Conta criada com sucesso',
        ]);
    }
}
