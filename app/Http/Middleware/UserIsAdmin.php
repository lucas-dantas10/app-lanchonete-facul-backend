<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        $user = $request->user();

        if (
            $user->is_admin == false
            || empty($user)
        ) {
            return new JsonResponse('Usuário não tem permissão!', Response::HTTP_FORBIDDEN);
        };

        return $next($request);
    }
}
