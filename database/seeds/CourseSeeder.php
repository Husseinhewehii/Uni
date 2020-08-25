<?php

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Models\Course::class, 10)->create()->each(function ($courses) {
            $courses->save(factory(App\Models\Course::class)->make()->toArray());
        });
    }
}