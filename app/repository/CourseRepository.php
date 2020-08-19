<?php

namespace App\repository;

use App\Models\Course;
use Illuminate\Support\Collection;

class CourseRepository
{

    protected $course;

    public function __construct(Course $course)
    {
        $this->course = $course;

    }

    public function getAll()
    {
        $courses = Course::query();
        return $courses;
    }



}
