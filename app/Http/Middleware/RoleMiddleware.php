<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RuntimeException;

final class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ?string $role = null)
    {
        if ($role === null) {
            return $next($request);
        }

        /** @var \App\Models\User $user */
        $user = $request->user();

        if ($user === null) {
            throw new RuntimeException('Unauthorized');
        }

        if ($user->getRole() !== $role) {
            throw new RuntimeException('Forbidden');
        }

        return $next($request);
    }
}
