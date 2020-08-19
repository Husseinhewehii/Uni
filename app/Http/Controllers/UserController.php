<?php

namespace App\Http\Controllers;


use App\repository\UserRepository;
use App\Http\Services\UserServices;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;



class UserController extends Controller
{
//    public function index()
//    {
//        $users = User::all() ;
//        return view('users.index',['users'=>$users]);
//    }

    private $userRepository;
    private $userServices;

    /**
     * @return mixed
     */
    public function __construct(UserRepository $userRepository, UserServices $userServices)
    {
        $this->userRepository = $userRepository;
        $this->userServices = $userServices;
    }


    public function index()
    {
        $users = $this->userRepository->getAll()->paginate(10);

        return view('users.index', ['users' => $users]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route('users.index'));
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(CreateUserRequest $request)
    {

        $this->userServices->createUser($request);
        return redirect(route('users.index'));
    }

    public function update(CreateUserRequest $request, User $user)
    {
        $this->userServices->updateUser($request, $user);
        return redirect(route('users.index'));
    }
}
