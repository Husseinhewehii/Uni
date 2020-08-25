<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCourseRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CourseUser;
use App\Models\Course;
use App\repository\CourseRepository;
use App\Http\Services\UserServices;

class UserCoursesController extends Controller
{

    private $courseRepository;
    private $userServices;

    public function __construct(CourseRepository $courseRepository, UserServices $userServices)
    {
        $this->courseRepository = $courseRepository;
        $this->userServices = $userServices;
    }

//    public function index(User $user){
//        $courses = $user->courses;
//        $professorCourses = $user->professorCourses;
//        return view('users.courses.index',['user'=>$user, 'courses' => $courses,'professorCourses'=>$professorCourses]);
//    }
//
    public function indexProfessor(User $user){
        $courses = $user->courses;
        $professorCourses = $user->professorCourses;
        return view('users.courses.professor_index',['user'=>$user, 'courses' => $courses,'professorCourses'=>$professorCourses]);
    }

    public function indexStudent(User $user){
        $courses = $user->courses;
        $professorCourses = $user->professorCourses;
        return view('users.courses.student_index',['user'=>$user, 'courses' => $courses,'professorCourses'=>$professorCourses]);
    }


    public function create(User $user){
        $courses = $this->courseRepository->getAll()->get();
        return view('users.courses.add',['user'=>$user, 'courses' => $courses]);
    }

    public function store(UserCourseRequest $request, User $user ){
        $this->userServices->createCourse(request(),$user);
        return redirect(route('users.courses.index.student',['user'=>$user]));

    }


    public function destroyStudent( User $user, Course $course)
    {
        $user->courses()->detach($course);
        return redirect()->back()->with('success', trans('Course removed successfully'));
//        $msg = 'Course removed successfully';
//        return redirect(route('users.courses.index',['user'=>$user]));
    }

    public function destroyProfessor( User $user, Course $course)
    {

        $user->professorCourses()->delete($course);
        return redirect()->back()->with('success', trans('Course removed successfully'));
//        $msg = 'Course removed successfully';
//        return redirect(route('users.courses.index',['user'=>$user]));
    }


}

