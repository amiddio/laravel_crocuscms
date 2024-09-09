<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AdminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentRoute = $request->route();
        if ($request->user()->role === null) {
            abort(403, __('This Admin is not linked to a any role'));
        }
        if (!Str::of($currentRoute->uri)->endsWith('/logout') && $request->user()->role->name != config('admin.super_admin_role_name')) {
            $isAccess = $request->user()->role->permissions->contains(function ($permission) use ($currentRoute) {
                $methods = Arr::map($currentRoute->methods(), function (string $value, string $key) {
                    return Str::of($value)->lower();
                });
                return (
                    $permission->route == Str::of($currentRoute->uri)->replace(
                        config('admin.admin_panel_prefix') . '/',
                        ''
                    ) &&
                    in_array($permission->method, $methods)
                );
            });
            if (!$isAccess) {
                abort(403);
            }
        }

        return $next($request);
    }
}
