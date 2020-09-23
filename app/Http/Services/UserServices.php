<?php

namespace app\Http\Services;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use App\repository\CourseRepository;
use App\Http\Services\UploaderService;

use Hash,Redirect;



class UserServices
    {
        protected $user;
        private $courseRepository;
        private $uploaderService;

            public function __construct(User $user, CourseRepository $courseRepository, UploaderService $uploaderService)
        {
            $this->user = $user;
            $this->courseRepository = $courseRepository;
            $this->uploaderService = $uploaderService;
        }

        public function updateUser(Request $request, User $user){

            if($request->hasFile('image')){
                $file = $request->file('image');
                $img = $this->uploaderService->upload($file,'users');
                $user->image = $img;
            }



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
///

            $user = new User();

            if($request->hasFile('image')){
                $file = $request->file('image');
                $img = $this->uploaderService->upload($file,'users');
                $user->image = $img;
            }


            $user->api_token=str_random(60);
            $user->remember_token=str_random(60);

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

        public function addImage(Request $request, User $user)
        {
            if($request->hasFile('image')){
                $file = $request->file('image');
                $img = $this->uploaderService->upload($file,'user_gallery');
            }
            $data = $request->all();
            $data['image'] = $img;
            $user->gallery()->create($data);
            $user->save();
            return $user;
        }

        public function changePassword(Request $request, User $user)
        {
            if (!$user) {
                return false;
            }
//            $currentPassword = $request->input('old_password');
//            if (!Hash::check($currentPassword, $user->password)) {
//
//
//                //return redirect(route('users.password.go.change',['user'=>$user]))->with('danger','Incorrect old Passwort');
////                return Redirect::back()->withErrors(['msg', 'The Message']);
////                return false;
//////              return response()->json(array('error' => 'Incorrect old Passwort'), 400);
/////
/////
/////               return redirect()->back()->with('danger', 'Incorrect old Passwort');
////               echo "$user->name wrong pass  test123456  ";die;
//
//            }
            $user->password = $request->input('new_password');
            $user->save();
            return $user;
        }
    }
