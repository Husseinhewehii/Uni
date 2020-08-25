<?php

namespace App\Http\Services;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;

class AuthService
{

    public function attempt(Request $request)
    {
        return auth()->attempt(
            ['email' => $request->request->get('email'), 'password' => $request->request->get('password')]
        );
    }

    public function registerFromRequest(Request $request, $user = null)
    {
        if (!$user) {
            $user = new User();
        }

        $user->fill($request->request->all());
        //$user->token = $user->createToken('Laravel Personal Access Client')->accessToken;
        $user->save();
        return $user;
    }

}
