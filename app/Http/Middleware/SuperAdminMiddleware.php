<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            $type = app('App\Http\Controllers\Admin\Auth\AdminAuthController')->admin_role();
            if ($type == 'superadmin') {
                return $next($request);
            }else{
                return redirect()->route($type.'.dashboard');
            }
        }
        return redirect()->route('admin.login');
        // return $next($request);
    }
}
