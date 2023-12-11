<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use HttpResponses;

    public function register(Request $request, User $user)
    {
        $userData = $request->only('name', 'email', 'password');
        $userData['password'] = bcrypt($userData['password']);

        $username = explode("@", $userData['email']);
        $userData['username'] = '@' . $username[0];

        if (!$user = $user->create($userData))
            abort(500, 'Error to create a new user...');

        return $this->response('User Registered', 201, $user);
    }
}
