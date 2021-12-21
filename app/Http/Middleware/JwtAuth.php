<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\ApiResponses;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use JWTAuth;

class JwtAuth
{
     use ApiResponses; 

    public function handle($request, Closure $next, $guard = null)
    {   dd($guard);
        if($guard != null){
            auth()->shouldUse($guard); //shoud you user guard / table
            $token = $request->header('auth-token');
            $request->headers->set('auth-token', (string) $token, true);
            $request->headers->set('Authorization', 'Bearer '.$token, true);
            try {
              //  $user = $this->auth->authenticate($request);  //check authenticted user
                $user = JWTAuth::parseToken()->authenticate();
            } catch (TokenExpiredException $e) {
                return  $this -> returnError('Unauthenticated user');
            } catch (JWTException $e) {

                return  $this -> returnError('token_invalid'.$e->getMessage());
            }

        }
         return $next($request);
    }

}
