<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        //
        'CUR_NOMBRE'=>$faker->name,
        'CUR_PARALELO'=>$faker->userName,
        'institution_id'=>$faker->numberBetween(1,100)
    ];
});
