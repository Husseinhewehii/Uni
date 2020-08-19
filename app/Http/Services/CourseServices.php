<?php

namespace app\Http\Services;
use App\Models\Course;
use Illuminate\Http\Request;
use app\Http\Requests\CreateCourseRequest;


class CourseServices
    {
        protected $course;

            public function __construct(Course $course)
        {
            $this->course = $course;

        }

        public function updateCourse(Request $request, Course $course){

            $course->fill($request->request->all());
            $course->save();

            return $course;

        }

        public function createCourse(Request $request)
        {
//            $request->validate(array(
////            'name'=>'required|max:255',
////            'password'=>'required|max:255',
////            'confirm_password'=>'required_with:password|same:password',
////            'gender'=>'required',
////            'type'=>'required',
////            'email' => 'required|email|unique:users,email'
////        ));

            $course = new Course();
            $course->fill($request->request->all());
            $course->save();

            return $course;

        }
    }
