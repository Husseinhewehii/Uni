<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReviewRequest;
use App\Http\Services\ReviewServices;
use App\Models\Course;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class CourseReviewController extends BaseController
{

    private $reviewServices;


    public function __construct(ReviewServices $reviewServices)
    {
        //$this->authorizeResource(Review::class,'review');
        $this->reviewServices = $reviewServices;
    }

    public function index(Course $course){
        //$this->authorize('view', [Review::class, $course]);
        $reviews = $course->reviews;
        return view('courses.reviews.index',['reviews'=>$reviews, 'course' => $course]);
    }

    public function create(Course $course, User $user){
        $this->authorize('create', [Review::class, $course]);
        return view('courses.reviews.create',['course'=>$course, 'user'=>$user]);
    }

    public function store(CreateReviewRequest $request, Course $course){
        $this->authorize('create', [Review::class, $course]);
        $this->reviewServices->createReview($request, $course);
        return redirect(route('course.reviews.index',['course'=>$course]))->with('success','A Review Has Just Been Added');
    }

    public function destroy(Course $course, Review $review){
        $this->authorize('delete', [Review::class, $course, $review]);
        $review->delete();
        return redirect(route('course.reviews.index',['course'=>$course]))->with('danger','The Review Has Just Been Deleted');
    }

    public function update(CreateReviewRequest $request, Course $course, Review $review){
        $this->authorize('update', [Review::class, $course, $review]);
        $this->reviewServices->updateReview($request, $review);
        return redirect(route('course.reviews.index',['course'=>$course]))->with('danger','The Review Has Just Been Updated');
    }

    public function edit(Course $course, Review $review){
        $this->authorize('update', [Review::class, $course, $review]);
        return view('courses.reviews.edit',['course'=>$course,'review'=>$review]);
    }
}
