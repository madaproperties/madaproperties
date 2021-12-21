<?php

namespace App\Http\Middleware;

use Closure;

class Lang
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
        if(auth()->check() && auth()->user()->lang AND !session()->has('lang'))
        {
          $lang = auth()->user()->lang;
        }else{
          $lang = session()->has('lang') ? session()->get('lang') : 'en';
        }
        app()->setlocale($lang);
        return $next($request);
    }
}
