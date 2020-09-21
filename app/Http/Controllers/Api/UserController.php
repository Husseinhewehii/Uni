<?php

namespace App\Http\Controllers\Api;


use App\Constants\UserTypes;
use App\Events\BenachrichtigungEvent;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Notifications\Benachrichtigung;
use App\repository\UserRepository;
use App\Http\Services\UserServices;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Auth, Password;


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
        $users = $this->userRepository->getAll(request())->paginate(10);

        request()->request->set('type', UserTypes::STUDENT);
//        request()->request->set('type', 2);
        $students = $this->userRepository->getAll(request())->paginate(10);

        return response()->json(['users' => $users, 'students' => $students]);
    }

    public function show()
    {

    }

    public function destroy(User $user)
    {
        $user->delete();

        response()->json(['user' => $user]);
    }

    public function edit(User $user)
    {
        return response()->json(['user' => $user]);
    }

    public function create()
    {
//        $users = Vendor::where('active', 1)->get();
//        return View::make('admin.users.create', ['vendors' => $vendors]);
        return view('users.create');
    }

    public function store(CreateUserRequest $request)
    {

        $this->userServices->createUser($request);
        return redirect(route('users.index'));
    }

    public function update(CreateUserRequest $request)
    {
        $this->userServices->updateUser($request, Auth::user());
        return response(['user'=>Auth::user()]);

    }

    public function ajax_form(){
        return view('users.ajax-form');
    }

    public function studentCourses()
    {
        $courses = Auth::user()->courses;

        return response(['courses' => $courses]);
    }

    public function sendPasswordResetLink(ResetPasswordRequest $request)
    {
        $email = $request->email;
        Password::broker()->sendResetLink(
            $request->only('email')
        );
        //  session()->flash('success', trans('passwords.sent'));
        return response(['message'=>"email sent to $email"]);
    }

    public function getNotifications(User $user){


        return response()->json($user->notifications);
    }

    public function postNotification(User $user){


//        $user->notify(new Benachrichtigung($user));
        event(new BenachrichtigungEvent($user));


        $notification = $user->notifications()->latest()->first();


        return $notification->toJson();
    }



}
