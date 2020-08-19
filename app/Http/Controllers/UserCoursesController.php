<?php

namespace App\Http\Controllers;

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

    public function index(User $user){
        $courses = $user->courses;
        return view('users.courses.index',['user'=>$user, 'courses' => $courses]);
    }

    public function create(User $user){

        $courses = $this->courseRepository->getAll()->get();
        return view('users.courses.add',['user'=>$user, 'courses' => $courses]);
    }

    public function store( User $user){
        $this->userServices->createCourse(request(),$user);
        return redirect(route('users.courses.index',['user'=>$user]));
    }


    public function destroy(User $user, Course $course)
    {
        $user->courses()->detach($course);
        return redirect()->back()->with('success', trans('Course removed successfully'));
//        $msg = 'Course removed successfully';
//        return redirect(route('users.courses.index',['user'=>$user]));
    }

    public function checkUserCourseRelation(User $user, Course $course)
    {
        if ($user->courses->contains($course))
        {
            echo 'Match';die;
        }else{
            echo 'No Match';die;
        }
    }

}

