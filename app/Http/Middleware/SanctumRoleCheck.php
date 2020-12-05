<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class SanctumRoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $user_role = $request->user()->role;
        if ($user_role !== $role) {
            return redirect(RouteServiceProvider::HOME)->withErrors([
                'title' => 'Accès refusé',
                'msg' => "Vous n'avez pas la permission d'accéder à cette page.",
                'type' => 'error',
            ]);
        }
        return $next($request);
    }
}
