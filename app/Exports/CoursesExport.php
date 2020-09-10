<?php

namespace App\Exports;

use App\Models\Course;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;


class CoursesExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function  array(): array
    {
        $courses = Course::all();
        $courses_excel = [
            [
                'course_id',
                'name' ,
                'start_date',
                'end_date',
                'professor'
            ]
        ];

        foreach($courses as $course)
        {
            $courses_excel[] = [
            'course_id' => $course->id,
            'name' => $course->name,
            'start_date' => $course->start_date,
           'end_date' => $course->end_date,
           'professor' => User::find($course->professor_id)->name
            ];
        }

        return [$courses_excel];
//

    }
}
