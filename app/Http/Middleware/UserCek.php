<?php

namespace App\Http\Middleware;
use Auth;

use Closure;

class UserCek
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(is_null(Auth::user())){
            return redirect('login')->with('error', "Anda harus login terlebih dahulu !!!");;
        }
        return $next($request);
    }
}
