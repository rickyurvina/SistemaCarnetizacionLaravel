<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'PER_CEDULA'=>$faker->numberBetween(1000000,99999999),
        'PER_NOMBRES'=>$faker->firstName,
        'PER_APELLIDOS'=>$faker->lastName,
        'PER_SEXO'=>$faker->randomElement(['Masculino','Femenino']),
        'PER_FECHANACIMIENTO'=>$faker->date(),
        'PER_TIPOSANGRE'=>$faker->randomElement(['O negativo','O positivo','A negativo','A positivo','B negativo','B positivo','AB negativo','AB positivo']),
        'PER_CORREO'=>$faker->email,
        'PER_DIRECCION'=>$faker->city(),
        'PER_NUMERO'=>$faker->numberBetween(1000000,2000000),
        'PER_CELULAR'=>$faker->numberBetween(100000000,200000000),
        'institution_id'=>$faker->numberBetween(1,100),
        'area_id'=>$faker->numberBetween(1,7),
    ];
});
