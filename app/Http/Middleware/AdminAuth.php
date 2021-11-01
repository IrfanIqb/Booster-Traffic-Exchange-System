<?php

namespace App\Http\Middleware;

use App\Libraries\Utils;
use Closure;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!\Auth::check())
        {
            return redirect()->to('/login');

        }
        if (\Auth::check()) {
            if(\Auth::user()->role!='admin')
            {
                return redirect()->to('/dashboard');
            }
        }

        return $next($request);
    }
}
