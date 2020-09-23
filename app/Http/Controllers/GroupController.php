<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupRequest;
use Illuminate\Http\Request;
use App\Models\Group;

use App\repository\GroupRepository;
use App\Http\Services\GroupServices;

class GroupController extends BaseController
{

    private $groupRepository;
    private $groupServices;

    /**
     * @return mixed
     */
    public function __construct(GroupRepository $groupRepository, GroupServices $groupServices)
    {

        $this->authorizeResource(Group::class, "group");
        $this->groupRepository = $groupRepository;
        $this->groupServices = $groupServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view',Group::class);
        $groups = $this->groupRepository->getAll()->paginate(10);
        return view('groups.index',['groups'=>$groups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGroupRequest $request)
    {
        $this->groupServices->createGroup($request);
        return redirect(route('groups.index'));
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
    public function edit(Group $group)
    {
        return view('groups.edit',['group'=>$group]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateGroupRequest $request,Group $group)
    {
        $this->groupServices->updateGroup($request,$group);
        return redirect(route('groups.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();
        return redirect(route('groups.index'));
    }
}
