<?php

namespace App\Http\Controllers;

use App\Exports\CoursesExport;
use App\Models\Course;
use App\Constants\UserTypes;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\repository\UserRepository;
use App\repository\CourseRepository;
use App\Http\Services\CourseServices;
use App\Http\Services\UserServices;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UserCourseRequest;
//use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use WkPdf,Excel;


class CourseController extends Controller
{
    private $courseRepository;
    private $courseService;
    private $userRepository;
    private $userServices;

    public function __construct(UserRepository $userRepository,CourseRepository $courseRepository, CourseServices $courseServices ,UserServices $userServices)
    {
        //$this->authorizeResource(Course::class, "course");
        $this->userRepository = $userRepository;
        $this->userService = $userServices;
        $this->courseRepository = $courseRepository;
        $this->courseService = $courseServices;
    }

    public function index(){
        //$this->authorize("view", Course::class);
        $courses = $this->courseRepository->getAll()->with('professor')->paginate(10);
        return view('courses.index',['courses'=>$courses]);
    }

    public function create(){
        $this->authorize('create',Course::class);
        request()->request->set('type',UserTypes::PROFESSOR);
        $professors = $this->userRepository->getAll(request())->get();

        return view('courses.create',['professors'=>$professors]);
    }

    public function edit(Course $course){
        $this->authorize('update',Course::class);
        return view('courses.edit',['course'=>$course]);
    }

//    public function store(CreateCourseRequest $request,UserCourseRequest $courserequest){
//        $this->courseService->createCourse($request);
//        $this->userServices->createCourse($courserequest,$this->courseRepository->getAll()->with('professor'));
//        return redirect(route('courses.index'));

    public function store(CreateCourseRequest $request){
        $this->authorize('create',Course::class);
        $this->courseService->createCourse($request);
        return redirect(route('courses.index'));
    }

    public function destroy(Course $course){
        $this->authorize('delete',Course::class);
        //$course->reviews()->delete();
        $course->delete();
        return redirect(route('courses.index'));
    }


    public function update(CreateCourseRequest $request, Course $course){
        $this->authorize('update',Course::class);
        $this->courseService->updateCourse($request, $course);
        return redirect(route('courses.index'));
    }

    public function exportPDF(Course $course,$form_number)
    {
        $users = $course->users;

        $data = ['course' => $course, 'users' => $users];
        $file = 'courses.pdf_forms.course_data_'.$form_number;

        $pdf = WkPDF::loadView($file, $data);
        return $pdf->download($course->name.'_course_data_'.$form_number.'.pdf');
    }


    public function exportExcel()
    {
        return Excel::download(new CoursesExport,'courses-' . time() . '.xlsx');
    }

    public function courseInsert(){
        $days = Carbon::now()->daysInMonth;
        $courses = $this->courseRepository->getAll()->with('professor')->paginate(10);

        $current_courses = [];
        foreach ($courses as $course){
            $current_course['name'] = $course->name;
            $current_course['professor_id'] = $course->professor_id;
            $current_courses[] = $current_course;
        }


//        $original_date = "2019-03-31";
//        $timestamp = strtotime($original_date);
        $year =  date("Y");
        $month =  date("m");
        $date = new \DateTime();
        $new_courses= [];

//        $new_date = date("d-m-Y");
//        echo $year;die;

        foreach (range(1, $days) as $number) {
            foreach (range(1,10) as $add_course){
                $key = array_rand($current_courses);
                $start_date = $year.'-'.$month.'-'.$number;

                $month_later = $month+1;

                $end_date = $year.'-'.$month_later.'-'.$number;

                $new_course= [
                    'name' => $current_courses[$key]['name'],
                    'start_date' =>  $start_date,
                    'end_date' =>  $end_date,
                    'professor_id'=> $current_courses[$key]['professor_id']
                ];
                $new_courses[] = $new_course;
                $course_to_database = New Course();
                $course_to_database->name = $new_course['name'];
                $course_to_database->professor_id = $new_course['professor_id'];
                $course_to_database->start_date = $new_course['start_date'];
                $course_to_database->end_date = $new_course['end_date'];
                $course_to_database->created_at = new \DateTime();
                $course_to_database->updated_at =new \DateTime();
                $course_to_database->save();
            }

        }
        return redirect()->back();
    }

}
