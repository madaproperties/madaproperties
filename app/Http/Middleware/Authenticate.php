<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Traits\ApiResponses;

class Authenticate extends Middleware
{
    use ApiResponses; 

    protected function redirectTo($request)
    { 
        if (! $request->expectsJson()) {
            return route('login');
        }
        
    }
}
