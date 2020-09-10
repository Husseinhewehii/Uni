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

    public function updateCourse(Request $request, Course $course)
    {

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

    public function createUser(Request $request, Course $course)
    {
        //
        //$courses = $this->courseRepository->getAll()->paginate(10);


        $user = $request->get('user');
        if ($course->users->contains($user)) {
            echo "there is a match";
            die;
        } else {
            $course->users()->syncWithoutDetaching($user);
            $course->save();

            return $course;
        }

        //$user->courses->contains($course)


    }

//    public function calculateAverageCourseRate(Course $course){
//        if($course->reviews()){
//            $rateSum = 0;
//            foreach($course->reviews as $review){
//                $rateSum += $review->rate;
//            }
//            $averageRate = truncate_number($rateSum/$course->reviews->count(),2);
//            return $averageRate;
//        }
//    }

}
