<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'PER_CEDULA'=>$faker->numberBetween(1000000000,2000000000),
        'PER_NOMBRES'=>$faker->firstName,
        'PER_APELLIDOS'=>$faker->lastName,
        'PER_SEXO'=>$faker->randomElement(['Masculino','Femenino']),
        'PER_FECHANACIMIENTO'=>$faker->date(),
        'PER_TIPOSANGRE'=>$faker->randomElement(['O negativo','O positivo','A negativo','A positivo','B negativo','B positivo','AB negativo','AB positivo']),
        'PER_CORREO'=>$faker->email,
        'PER_DIRECCION'=>$faker->city(),
        'PER_NUMERO'=>$faker->numberBetween(100000000,200000000),
        'PER_CELULAR'=>$faker->numberBetween(1000000000,2000000000),
        'institution_id'=>$faker->randomElement([3,4,9,11,12,13,14]),
        'area_id'=>$faker->randomElement([1,2,3,4,5,6,7,8,9]),
    ];
});
