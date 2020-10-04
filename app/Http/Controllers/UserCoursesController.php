<?php

namespace App\Http\Controllers;

use App\Constants\WeekDaysTypes;
use App\Http\Requests\UserCourseRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CourseUser;
use App\Models\Course;
use App\repository\CourseRepository;
use App\Http\Services\UserServices;

class UserCoursesController extends BaseController
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





//
//public function getDaysDates($class_days){
//    $dates = [];
//    foreach ($class_days as $day){
//        $dates[] = date("Y-m-d", strtotime("next $day"));
//    }
//    return $dates;
//}
//
//function getStartDay($array, $date)
//{
//    //$count = 0;
//    foreach($array as $day)
//    {
//        //$interval[$count] = abs(strtotime($date) - strtotime($day));
//        $interval[] = abs(strtotime($date) - strtotime($day));
//        //$count++;
//    }
//
//    asort($interval);
//    $closest = key($interval);
//
//    $day = date("l", strtotime($array[$closest]));
//    return $day;
//}
//
//function schedule(){
//    #given data
//    $days = [1,3,5];
//    $class_count = 16;
//    $session = 1;
//
//
//    sort($days);
//    $class_days = [];
//    foreach ($days as $day){
//        $class_days[] = WeekDaysTypes::getOne($day);
//    }
//
//    #schedule days
//    $schedule = [];
////        $class_days = ['wednesday','saturday','monday'];
//    $tomorrow = strtotime("tomorrow");
//    $tomorrow_date = date("Y-m-d",$tomorrow);
//
//
//    $start_day = strtolower($this->getStartDay($this->getDaysDates($class_days), strtotime("today")));
//
//    $started = false;
//    while($class_count > 0){
//        foreach ($class_days as $day){
//            if($class_count > 0){
//                if($started){
//                    $day_date = date("Y-m-d", strtotime("next $day",strtotime($start_day)));
//                    if($day_date != $tomorrow_date){
//                        $schedule[] = ['session'=>$session,'day'=>$day,'date'=>$day_date];
//                        $session++;
//                        $class_count--;
//                        $start_day = $day_date;
//                    }
//                }
//
//                if($day == $start_day){
//                    $day_date = date("Y-m-d", strtotime("next $start_day"));
//                    $started  = true;
//                    $start_day = $day_date;
//                    if($day_date != $tomorrow_date){
//                        $schedule[] = ['session'=>$session,'day'=>$day,'date'=>$day_date];
//                        $session++;
//                        $class_count--;
//                    }
//                }
//
//            }
//
//        }
//    }
//
//
//    echo"<pre>";print_r($schedule);die;
//
//}
//





//class LesionService
//{
//    public function getLesionActualDate($days, $sessionsNumber)
//{
//    $days = $this->orderLesionDays($days);
//    $dates = [];
//    $count = 0;
//    $firstDate = '';
//    while ($count < $sessionsNumber) {
//        for ($i = 0; $i < count($days); $i++) {
//            if ($count < $sessionsNumber) {
//                $date = date('Y-m-d', strtotime('next ' .$days[$i]));
//                if ($firstDate != '') {
//                    $date = date('Y-m-d', strtotime('next ' .$days[$i], strtotime($firstDate)));
//                }
//
//                $dates [] = $date;
//                $firstDate = $date;
//                $count++;
//            }
//        }
//    }
//
//    return $dates;
//}
//
//    public function orderLesionDays($days)
//{
//    foreach ($days as $day) {
//        $dates[] = Carbon::parse('next ' . WeekDaysTypes::getOne($day));
//    }
//    usort($dates, function($a, $b) {
//        return $a <=> $b;
//    });
//
//    if ($dates[0]->format('l') == Carbon::tomorrow()->format('l')) {
//        array_push($dates, $dates[0]);
//        array_shift($dates);
//    }
//
//    for ($i = 0; $i < count($dates); $i++) {
//        $dates[$i] = $dates[$i]->format('l') ;
//    }
//
//    return $dates;
//}
//}
