<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFactor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user=auth()->user();
        if(auth()->check()&&$user->code) // user enter email and password correct and have code in DataBase
        {
           if(!request()->is('verify*'))
           {
            return redirect()->route('verify.index');
           }
        }
        return $next($request);
    }
}
