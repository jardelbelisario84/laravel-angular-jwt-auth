<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{

    private $jwtAuth;


    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }



    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        // attempt to verify the credentials and create a token for the user
        if (! $token = $this->jwtAuth->attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        $user = $this->jwtAuth->authenticate($token);
    
        // all good so return the token
        return response()->json(compact('token', 'user'));
    }




    // somewhere in your controller
    public function getAuthenticatedUser()
    {   
        
     
        if (! $user = $this->jwtAuth->parseToken()->authenticate()) {
            return response()->json(['error' => 'user_not_found'], 404);
        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }


    public function refresh()
    {
        $token = $this->jwtAuth->getToken();
        $token = $this->jwtAuth->refresh($token);

        return response()->json(compact('token'));
    }

    public function logout()
    {
        $token = $this->jwtAuth->getToken();
        $token = $this->jwtAuth->invalidate($token);

        return response()->json(['message' => "logout success!"]);
    }


}
