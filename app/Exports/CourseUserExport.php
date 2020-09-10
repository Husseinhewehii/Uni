<?php

namespace App\Exports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CourseUserExport implements FromArray, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $course;
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function array(): array
    {
        $courseUsers = [];
        $users = $this->course->users;
        foreach($users as $user)
        {
            $courseUsers[] = [
                $user->id,
                $user->name,
                $user->email,
                $user->date_of_birth,
                $user->gender
            ];
        }
        return [$courseUsers];
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'Date Of Birth',
            'Gender'
        ];
    }
}
