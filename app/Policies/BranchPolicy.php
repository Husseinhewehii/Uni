<?php

namespace App\Policies;

use App\Constants\UserTypes;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Auth\Access\HandlesAuthorization;

class BranchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the branch index.
     *
     * @param User $user
     * @return bool
     */
    public function before(User $user)
    {
        // check if the user is not admin return false before access any rolls
        if (!$user->isTypeOf(UserTypes::ADMIN)) {
            return false;
        }
    }

    /**
     * Determine whether the user can view the branch index.
     *
     * @param User $user
     * @return bool
     */
    public function index(User $user)
    {
        return $user->hasAccess("admin.branches.index");
    }

    /**
     * Determine whether the user can create branches.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess("admin.branches.create");
    }

    /**
     * Determine whether the user can update the branch.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Branch  $branch
     * @return mixed
     */
    public function update(User $user, Branch $branch)
    {
        return $user->hasAccess("admin.branches.update");
    }

    /**
     * Determine whether the user can delete the branch.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Branch  $branch
     * @return mixed
     */
    public function delete(User $user, Branch $branch)
    {
        return $user->hasAccess("admin.branches.destroy");
    }
}
