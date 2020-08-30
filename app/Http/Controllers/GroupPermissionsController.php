<?php

namespace App\Http\Controllers;



use App\Models\Group;
use App\Models\Permission;
use App\Models\GroupPermission;
use Illuminate\Http\Request;
use App\Http\Services\GroupPermissionService;
use View;

class GroupPermissionsController extends Controller
{

    protected $groupPermissionService;

    public function __construct(GroupPermissionService $groupPermissionService)
    {
        //$this->authorizeResource(GroupPermission::class,'groupPermission');
        $this->groupPermissionService = $groupPermissionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Group $group
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group)
    {
        $this->authorize('view',GroupPermission::class);
        $permissions = Permission::where('status', 1)->get();
        return view('groups.permissions.index', ['permissions' => $permissions, 'group' => $group]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Group $group)
    {
        $this->groupPermissionService->createGroupPermission($request,$group);
        return redirect(route('groups.index',['group'=>$group]));
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
    public function destroy($id)
    {
        //
    }
}
