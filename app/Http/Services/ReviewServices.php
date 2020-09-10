<?php

namespace app\Http\Services;

use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;
use app\Http\Requests\CreateCourseRequest;


class ReviewServices
    {
        protected $review;

            public function __construct(Review $review)
        {
            $this->review = $review;

        }

        public function updateReview(Request $request, Review $review){

            $review->fill($request->request->all());
            $review->save();

            return $review;

        }

        public function createReview(Request $request, Course $course, $review = null)
        {
//            $request->validate(array(
////            'name'=>'required|max:255',
////            'password'=>'required|max:255',
////            'confirm_password'=>'required_with:password|same:password',
////            'gender'=>'required',
////            'type'=>'required',
////            'email' => 'required|email|unique:users,email'
////        ));

            if(!$review){
                $review = new Review();
            }


            $review->fill($request->request->all());
            $course->reviews()->save($review);

            return $review;

        }

    public function createUser(Request $request, Review $review)
    {
        //
        //$courses = $this->courseRepository->getAll()->paginate(10);


        $user = $request->get('user');
        if ($review->users->contains($user))
        {
            echo "there is a match";die;
        }else{
            $review->users()->syncWithoutDetaching($user);
            $review->save();

            return $review;
        }

        //$user->courses->contains($course)



    }

}
