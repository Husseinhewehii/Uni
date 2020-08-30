<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupUserRequest;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use App\repository\UserRepository;
use App\Http\Services\GroupServices;
use App\Constants\UserTypes;

class GroupUsersController extends Controller
{
    private $userRepository;
    private $groupServices;

    public function __construct(UserRepository $userRepository, GroupServices $groupServices)
    {
        $this->userRepository = $userRepository;
        $this->groupServices = $groupServices;
    }

    public function index(Group $group){
        $admins = $group->admins;
        return view('groups.admins.index',['admins'=>$admins, 'group' => $group]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group){
        request()->request->set('type',UserTypes::ADMIN);

        $admins = $this->userRepository->getAll(request())->get();
        return view('groups.admins.add',['admins'=>$admins, 'group' => $group]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupUserRequest $request, Group $group){
        $this->groupServices->createUser($request, $group);
        return redirect(route('group.users.index',['group'=>$group]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group, User $user)
    {
        $group->admins()->detach($user);
        return redirect()->back()->with('success', trans('User removed successfully'));
    }
}
