<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\repository\CourseRepository;
use App\Http\Services\CourseServices;
use App\Http\Requests\CreateCourseRequest;

class CourseController extends Controller
{
    private $courseRepository;
    private $courseService;

    public function __construct(CourseRepository $courseRepository, CourseServices $courseServices)
    {
        $this->courseRepository = $courseRepository;
        $this->courseService = $courseServices;
    }

    public function index(){
        $courses = $this->courseRepository->getAll()->paginate(10);
        return view('courses.index',['courses'=>$courses]);
    }

    public function create(){
        return view('courses.create');
    }

    public function edit(Course $course){
        return view('courses.edit',['course'=>$course]);
    }

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
