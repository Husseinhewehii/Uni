<?php

namespace App\Policies;

use App\Constants\UserTypes;
use App\Models\User;
use App\Models\GroupPermission;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any group permissions.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function before(User $user)
    {
        if(!$user->isTypeOf(UserTypes::ADMIN)){
            return false;
        }
    }

    /**
     * Determine whether the user can view the group permission.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupPermission  $groupPermission
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasAccess('group.permissions.index');
    }

    /**
     * Determine whether the user can create group permissions.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the group permission.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupPermission  $groupPermission
     * @return mixed
     */
    public function update(User $user, GroupPermission $groupPermission)
    {
        return $user->hasAccess('group.permissions.store');
    }

    /**
     * Determine whether the user can delete the group permission.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupPermission  $groupPermission
     * @return mixed
     */
    public function delete(User $user, GroupPermission $groupPermission)
    {
        //
    }

    /**
     * Determine whether the user can restore the group permission.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupPermission  $groupPermission
     * @return mixed
     */
    public function restore(User $user, GroupPermission $groupPermission)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the group permission.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupPermission  $groupPermission
     * @return mixed
     */
    public function forceDelete(User $user, GroupPermission $groupPermission)
    {
        //
    }
}
