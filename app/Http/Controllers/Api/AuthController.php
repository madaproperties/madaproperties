<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['login']]);
    }
    /**********************************************************/
    /***************************** Login ***********************/
    public function login()
    {
      
        $credentials = request(['email', 'password']);
        
        if(!request('email') OR !request('password'))
        {
            return response()->json(['error' => 'email and password required'], 400);
        }
            
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'wrong email or password '], 401);
        }
        
        $data = [
            'token' => $token,
            'user' => auth('api')->user()
        ];
        
        return $this->respondWithToken($data);
    }
    /**********************************************************/
    /***************************** ME ***********************/
    public function me()
	{
	    return response()->json(auth('api')->user());
	}
	/**********************************************************/
    /***************************** logout ***********************/
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    /**********************************************************/
    /***************************** refresh ***********************/
    public function refresh()
    {  
        return $this->respondWithToken(auth('api')->refresh());
    }
    /**********************************************************/
    /***************************** respondWithToken ***********************/
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
