<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InstallCheck
{
    public function handle(Request $request, Closure $next): mixed
    {
        // Allow installer routes
        if ($request->routeIs('install.*')) {
            if (File::exists(storage_path('installed')) && !$request->routeIs('install.welcome')) {
                return redirect('/');
            }
            return $next($request);
        }

        // If not installed, redirect to installer
        if (!File::exists(storage_path('installed'))) {
            return redirect()->route('install.welcome');
        }

        return $next($request);
    }
}