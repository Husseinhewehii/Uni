<?php

namespace App\Policies;

use App\Constants\UserTypes;
use App\Models\User;
use App\Models\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any courses.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function before(User $user)
    {
        // check if the user is not admin return false before access any rolls
//        if(!$user->isTypeOf(UserTypes::ADMIN)){
//            return false;
//        }
    }

    /**
     * Determine whether the user can view the course.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Course  $course
     * @return mixed
     */
    public function view(User $user)
    {
//        return $user->hasAccess('courses.index');

    }

    /**
     * Determine whether the user can create courses.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess('courses.store');
    }

    /**
     * Determine whether the user can update the course.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Course  $course
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasAccess('courses.update');
    }

    /**
     * Determine whether the user can delete the course.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Course  $course
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasAccess('courses.destroy');
    }

    /**
     * Determine whether the user can restore the course.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Course  $course
     * @return mixed
     */
    public function restore(User $user, Course $course)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the course.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Course  $course
     * @return mixed
     */
    public function forceDelete(User $user, Course $course)
    {
        //
    }
}
