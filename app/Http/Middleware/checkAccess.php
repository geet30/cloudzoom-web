<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    { 
        // if (! \Auth::check()) {
        //     return redirect()->route('login');
        // }
        // if (\Auth::user()->type == 0) {
            return $next($request);
        // }
        // return redirect('logout');
    }    
}
