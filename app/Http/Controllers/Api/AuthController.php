<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Http\Services\AuthService;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;
use Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $authService = new AuthService;

        $user = $authService->registerFromRequest($request);

        return response()->json($user);
    }

    public function login(LoginRequest $request)
    {
        $login = $request->all();

        if(!Auth::attempt($login))
        {
            return response(['message' => 'Invalid Login Credentials']);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return response(['user'=> Auth::user(), 'access_token'=> $accessToken]);
    }
}
