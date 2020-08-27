<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Constants\UserTypes;
use Illuminate\Http\Request;
use App\repository\UserRepository;
use App\repository\CourseRepository;
use App\Http\Services\CourseServices;
use App\Http\Services\UserServices;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UserCourseRequest;

class CourseController extends Controller
{
    private $courseRepository;
    private $courseService;
    private $userRepository;
    private $userServices;

    public function __construct(UserRepository $userRepository,CourseRepository $courseRepository, CourseServices $courseServices ,UserServices $userServices)
    {
        $this->authorizeResource(Course::class, "course");
        $this->userRepository = $userRepository;
        $this->userService = $userServices;
        $this->courseRepository = $courseRepository;
        $this->courseService = $courseServices;
    }

    public function index(){
        $this->authorize("view", Course::class);
        $courses = $this->courseRepository->getAll()->with('professor')->paginate(10);
        return view('courses.index',['courses'=>$courses]);
    }

    public function create(){
        //$this->authorize('create',Course::class);
        request()->request->set('type',UserTypes::PROFESSOR);
        $professors = $this->userRepository->getAll(request())->get();

        return view('courses.create',['professors'=>$professors]);
    }

    public function edit(Course $course){
        return view('courses.edit',['course'=>$course]);
    }

//    public function store(CreateCourseRequest $request,UserCourseRequest $courserequest){
//        $this->courseService->createCourse($request);
//        $this->userServices->createCourse($courserequest,$this->courseRepository->getAll()->with('professor'));
//        return redirect(route('courses.index'));

    public function store(CreateCourseRequest $request){

        $this->courseService->createCourse($request);
        return redirect(route('courses.index'));
    }

    public function destroy(Course $course){
        $course->delete();
        return redirect(route('courses.index'));
    }


    public function update(CreateCourseRequest $request, Course $course){
        $this->courseService->updateCourse($request, $course);
        return redirect(route('courses.index'));
    }
}
