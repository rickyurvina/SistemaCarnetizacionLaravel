<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Institution;
use Faker\Generator as Faker;

$factory->define(Institution::class, function (Faker $faker) {
    return [
        //
        'INS_NOMBRE'=>$faker->company,
        'INS_DIRECCION'=>$faker->city(),
        'INS_TELEFONO'=>$faker->numberBetween(1000000,2000000),
        'INS_CELULAR'=>$faker->numberBetween(100000000,200000000),
        'INS_TIPO'=>$faker->randomElement(['Institución Educativa','Organización']),
    ];
});
