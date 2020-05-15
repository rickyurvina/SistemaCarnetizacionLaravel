<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        //
        'CUR_NOMBRE'=>$faker->name,
        'CUR_PARALELO'=>$faker->userName,
        'institution_id'=>$faker->randomElement([1,2,5,6,7,8,10,15]),
    ];
});
