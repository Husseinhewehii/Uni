<?php

namespace App\Http\Controllers;


use App\Constants\UserTypes;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ConfirmResetPasswordRequest;
use App\repository\UserRepository;
use App\Http\Services\UserServices;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Password, Str, Auth;
use Hash;


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


    public function indexAdmins()
    {

        $users = $this->userRepository->getAll(request())->paginate(10);

        request()->request->set('type', UserTypes::ADMIN);
//        request()->request->set('type', 2);
        $admins = $this->userRepository->getAll(request())->paginate(10);

        return view('users.admin_index', ['admins' => $admins]);
    }

    public function indexProfessors()
    {

        $users = $this->userRepository->getAll(request())->paginate(10);

        request()->request->set('type', UserTypes::PROFESSOR);
//        request()->request->set('type', 2);
        $professors = $this->userRepository->getAll(request())->paginate(10);

        return view('users.professor_index', ['professors' => $professors]);
    }

    public function indexStudents()
    {
        $users = $this->userRepository->getAll(request())->paginate(10);

        request()->request->set('type', UserTypes::STUDENT);
//        request()->request->set('type', 2);
        $students = $this->userRepository->getAll(request())->paginate(10);

        return view('users.student_index', ['students' => $students]);
    }

    public function show()
    {

    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('danger',"User:$user->id ($user->name) has just been deleted successfully");
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
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
        return redirect(route('home'));
    }

    public function update(CreateUserRequest $request, User $user)
    {
        $this->userServices->updateUser($request, $user);
        return redirect('/');
    }

    public function ajax_form()
    {
        return view('users.ajax-form');
    }

    public function goLogin()
    {
        return view('users.login');
    }

    public function forgotPassword()
    {
        return view('users.forgot_password');
    }

    public function sendPasswordResetLink(ResetPasswordRequest $request)
    {
        $email = $request->email;
        Password::broker()->sendResetLink(
            $request->only('email')
        );
        //  session()->flash('success', trans('passwords.sent'));
        return view('users.password_reset_confirmation',['email'=>$email]);
    }

    public function resetPassword(ConfirmResetPasswordRequest $request)
    {
        $response = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, $password) {
//                $user->password = Hash::make($password);
                $user->password = $password;
                $user->setRememberToken(Str::random(60));
                $user->save();

                //event(new PasswordReset($user));

                Auth::guard()->login($user);
            }
        );

        if ($response != Password::PASSWORD_RESET) {
            return redirect()->back()->with('error', trans($response));
        }

        return redirect('/');
    }

    public function goReset(Request $request)
    {
            if ($request->query->has('token')) {
                return view('users.resetter');
            }


        return view('users.reset_password');
    }

    public function goChangePassword(User $user){
        return view('users.change_password',['user'=>$user]);
    }

    public function updatePassword(ChangePasswordRequest $request,User $user){
        $this->userServices->changePassword($request, $user);
        return redirect('/')->with('success', 'password_updated_successfully');
    }


}
