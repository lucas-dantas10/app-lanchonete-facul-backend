<?php 

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController
{
    public function __invoke(Request $request): JsonResponse
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return new JsonResponse([
            "message" => "Deslogado!",
            "status" => JsonResponse::HTTP_NO_CONTENT,
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
