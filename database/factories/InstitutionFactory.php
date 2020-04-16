<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Institution;
use Faker\Generator as Faker;

$factory->define(Institution::class, function (Faker $faker) {
    return [
        //
        'INS_NOMBRE'=>$faker->name,
        'INS_DIRECCION'=>$faker->city,
        'INS_TELEFONO'=>$faker->randomNumber(),
        'INS_CELULAR'=>$faker->randomNumber(),
        'INS_TIPO'=>$faker->text(150),
    ];
});
