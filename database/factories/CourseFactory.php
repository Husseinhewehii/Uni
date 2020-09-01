<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {

    $day = rand(-30,30);
    $duration = rand(2,3);
    return [
        'name' => $faker->randomElement(['Math','English','Marketing','Economics','Physics','Programming','Database']),
        $start_date = 'start_date' =>  $faker->dateTimeInInterval($start_date = " $day days"),
        'end_date' =>  $faker->dateTimeInInterval($end_date = "$start_date + $duration months"),
        'professor_id'=>2
    ];
});
