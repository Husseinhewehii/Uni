<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use App\Models\Review;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class ReviewPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any reviews.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function before(User $user)
    {
        //return Auth()->user() == $user;
    }

    /**
     * Determine whether the user can view the review.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Review  $review
     * @return mixed
     */
    public function view(User $user, Course $course)
    {
        return true;
    }

    /**
     * Determine whether the user can create reviews.
     *
     * @param User $course
     * @return mixed
     */
    public function create(User $user, Course $course)
    {
        return $user->courses->contains($course);

    }

    /**
     * Determine whether the user can update the review.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Review  $review
     * @return mixed
     */
    public function update(User $user, Course $course, Review $review)
    {
        return $user->courses->contains($course) && $review->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the review.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Review  $review
     * @return mixed
     */
    public function delete(User $user, Course $course, Review $review)
    {
        return $user->courses->contains($course) && $review->user_id == $user->id;
    }

    /**
     * Determine whether the user can restore the review.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Review  $review
     * @return mixed
     */
    public function restore(User $user, Course $course)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the review.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Review  $review
     * @return mixed
     */
    public function forceDelete(User $user, Review $review)
    {
        //
    }
}
