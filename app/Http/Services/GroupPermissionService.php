<?php

namespace App\Http\Services;

use App\Models\GroupPermission;
use App\Models\Group;
use Symfony\Component\HttpFoundation\Request;

class GroupPermissionService
{

    public function updateGroupPermission(Request $request, $groupPermission = null)
    {
        if (!$groupPermission) {
            $groupPermission = new GroupPermission();
        }
        $groupPermission->fill($request->request->all());
        $groupPermission->save();
        return $groupPermission;
    }

    public function createGroupPermission(Request $request, Group $group)
    {

        //$courses = $this->courseRepository->getAll()->paginate(10);
        if (!$group) {
            return false;
        }

        $permissions = $request->get('permissions');
        $group->permissions()->sync($permissions);
        return $group;


    }
}
