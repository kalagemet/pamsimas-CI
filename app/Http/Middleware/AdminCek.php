<?php

namespace App\Http\Middleware;
use Auth;

use Closure;

class AdminCek
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
        if(is_null(Auth::guard('admin')->user())){
            return redirect('login')->with('error', "Anda harus login terlebih dahulu !!!");
        }
        return $next($request);
    }
}
