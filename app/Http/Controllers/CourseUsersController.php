<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseUserRequest;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\repository\UserRepository;
use App\Http\Services\CourseServices;


class CourseUsersController extends Controller
{
    private $userRepository;
    private $courseServices;

    public function __construct(UserRepository $userRepository, CourseServices $courseServices)
    {
        $this->userRepository = $userRepository;
        $this->courseServices = $courseServices;
    }

    public function index(Course $course){
        $users = $course->users;
        return view('courses.users.index',['users'=>$users, 'course' => $course]);
    }

    public function create(Course $course){
        $users = $this->userRepository->getAll(request())->get();
        return view('courses.users.add',['users'=>$users, 'course' => $course]);
    }

    public function store(CourseUserRequest $request, Course $course){
        $this->courseServices->createUser($request, $course);
        return redirect(route('courses.users.index',['course'=>$course]));
    }

    public function destroy(Course $course,User $user)
    {
        $course->users()->detach($user);
        return redirect()->back()->with('success', trans('User removed successfully'));
//        $msg = 'Course removed successfully';
//        return redirect(route('users.courses.index',['user'=>$course])users
    }
}

