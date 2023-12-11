<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) abort(401, 'Invalid Credentials');

        $token = auth()->user()->createToken('auth_token');

        return $this->response('User Loged', 201, [
            'token' => $token->plainTextToken,
            'user_name' => auth()->user()->name,
            'user_id' => auth()->user()->id,
            'user_credits' => auth()->user()->credits
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete(); //remove all user tokens

        //auth()->user()->currentAccessToken()->delete(); //remove only request token

        return $this->response('All Tokens Deleted', 200, []);
    }

    public function verify()
    {
        return $this->response('Valid Token', 200, ['message' => 'Valid Token']);
    }
}
