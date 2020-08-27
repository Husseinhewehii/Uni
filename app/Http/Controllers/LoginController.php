<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\AuthService;
use App\Models\User;
use App\Http\Requests\Api\LoginRequest;

class LoginController extends Controller
{
    private $auth;

    function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function login(LoginRequest $request)
    {
        //$login = $request->except(['_token']);

        if(!$this->auth->attempt($request))
        {
            return response(['message' => 'Incorrect Credentials']);
        }



//        $user = auth()->user();
//        if($user->type == 1){
//            return redirect(route('users.admins'));
//        }
        return redirect('/');

    }

}
