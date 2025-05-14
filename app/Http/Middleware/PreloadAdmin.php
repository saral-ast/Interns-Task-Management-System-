<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PreloadAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only run if admin is authenticated
        if (Auth::guard('admin')->check()) {
            // Get the admin and eager load role and permissions
            $admin = Auth::guard('admin')->user();
            
            // Only load if not already loaded
            if (!$admin->relationLoaded('role')) {
                $admin->load(['role', 'rolePermissions' => function($query) {
                    $query->select('permissions.id', 'permission');
                }]);
            }
        }
        
        return $next($request);
    }
} 