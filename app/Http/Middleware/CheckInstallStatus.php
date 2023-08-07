<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckInstallStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (is_file(base_path('install.lock'))) {
            abort(403, trans('Please delete the install.lock file in the root directory of the project and refresh the page'));
        }
        if (!function_exists('symlink')) {
            abort(403, trans('Please enable the symlink function in php.ini! Then refresh the current page for system installation. You can close the symlink function after the system installation is completed.'));
        }
        return $next($request);
    }
}
