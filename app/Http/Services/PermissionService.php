<?php

namespace App\Http\Services;

use App\Models\Permission;
use Symfony\Component\HttpFoundation\Request;

class PermissionService
{

    public function updatePermission(Request $request, $permission = null)
    {
        if (!$permission) {
            $permission = new Permission();
        }

        $permission->fill($request->request->all());
        $permission->status = $request->request->get('status', 0);
        $permission->save();

        return $permission;
    }

}
