<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (in_array(Auth::user()->id, config("app.adminsId"))) {
            return $next($request);
        }

        return redirect()->route('homepage');
    }
}