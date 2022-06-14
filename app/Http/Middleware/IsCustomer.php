<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsCustomer
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
        if(auth()->user() == null){
            return redirect()->route('main.login');
        }
        if(auth()->user()->level == 'customer'){
            return $next($request);
        }
   
        return redirect()->route('main.login')->with('error', "Silakan masuk terlebih dahulu");
    }
}
