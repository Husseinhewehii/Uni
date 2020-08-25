<?php

namespace app\Http\Services;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use App\repository\CourseRepository;



class UserServices
    {
        protected $user;
        private $courseRepository;

            public function __construct(User $user, CourseRepository $courseRepository)
        {
            $this->user = $user;
            $this->courseRepository = $courseRepository;

        }

        public function updateUser(Request $request, User $user){

            $user->fill($request->request->all());
            $user->save();

            return $user;

        }

        public function createUser(Request $request)
        {
//            $request->validate(array(
////            'name'=>'required|max:255',
////            'password'=>'required|max:255',
////            'confirm_password'=>'required_with:password|same:password',
////            'gender'=>'required',
////            'type'=>'required',
////            'email' => 'required|email|unique:users,email'
////        ));

            $user = new User();
            $user->fill($request->request->all());
            $user->save();

            return $user;

        }

        public function createCourse(Request $request, User $user)
        {
    //
            //$courses = $this->courseRepository->getAll()->paginate(10);


            $course = $request->get('course');
            if ($user->courses->contains($course))
            {
                echo "there is a match";die;
            }else{
                $user->courses()->syncWithoutDetaching($course);
                $user->save();

                return $user;
            }

            //$user->courses->contains($course)



        }
    }
