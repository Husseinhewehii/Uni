<?php

namespace App\Http\Controllers\Api;

use app\Http\Services\UserServices;
use App\repository\CourseRepository;
use Illuminate\Routing\Controller;
use App\Http\Services\AuthService;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;
use Auth;

class AuthController extends Controller
{

    private $courseRepository;
    private $userServices;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;


    }

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

        //passport install is required
        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return response(['user'=> Auth::user(), 'access_token'=> $accessToken]);

    }
}
