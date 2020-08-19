<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseUsersController extends Controller
{
    public function index(Course $course){
        return view('courses.users.index',['course'=>$course]);
    }
}
