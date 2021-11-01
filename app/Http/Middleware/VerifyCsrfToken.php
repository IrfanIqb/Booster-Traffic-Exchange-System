<?php namespace App\Http\Middleware;

use App\Points;
use App\User;
use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
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
        \App::setLocale(\Session::get('lang', 'en'));


        return parent::handle($request, $next);
    }

}
