<?php

namespace app\Http\Services;
use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use App\repository\GroupRepository;



class GroupServices
    {
        protected $group;


            public function __construct(Group $group)
        {
            $this->group = $group;


        }

        public function updateGroup(Request $request, Group $group){

            $group->fill($request->request->all());
            $group->save();

            return $group;

        }

        public function createGroup(Request $request)
        {
//            $request->validate(array(
////            'name'=>'required|max:255',
////            'password'=>'required|max:255',
////            'confirm_password'=>'required_with:password|same:password',
////            'gender'=>'required',
////            'type'=>'required',
////            'email' => 'required|email|unique:groups,email'
////        ));

            $group = new Group();
            $group->fill($request->request->all());
            $group->save();

            return $group;

        }

        public function createUser(Request $request, Group $group)
        {

            //$courses = $this->courseRepository->getAll()->paginate(10);


            $admin = $request->get('user');
            if ($group->admins->contains($admin))
            {
                echo "there is a match";die;
            }else{
                $group->admins()->syncWithoutDetaching($admin);
                $group->save();

                return $group;
            }

            //$user->courses->contains($course)
        }
    }
