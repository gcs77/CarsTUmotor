<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'No autenticado.'], 401);
        }

        $allowedRoles = explode(',', $roles);

        $hasRole = false;
        foreach ($allowedRoles as $role) {
            if ($user->hasRole(trim($role))) {
                $hasRole = true;
                break;
            }
        }

        if (!$hasRole) {
            return response()->json([
                'message' => 'No tiene permisos para acceder a este recurso.',
            ], 403);
        }

        return $next($request);
    }
}
