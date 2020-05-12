<?php

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;


class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Course::class, 50)->create();
    }
}
