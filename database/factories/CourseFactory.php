<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        //
        'CUR_NOMBRE'=>$faker->name,
        'CUR_PARALELO'=>$faker->userName,
        'institution_id'=>$faker->randomElement([2,6,7,8,9,12,15]),
    ];
});
