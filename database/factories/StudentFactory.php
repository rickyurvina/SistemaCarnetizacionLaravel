<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        //
        'EST_CEDULA'=>$faker->numberBetween(1000000000,2000000000),
            'EST_NOMBRES'=>$faker->firstName,
            'EST_APELLIDOS'=>$faker->lastName,
            'EST_SEXO'=>$faker->randomElement(['Masculino','Femenino']),
            'EST_FECHANACIMIENTO'=>$faker->date(),
            'EST_TIPOSANGRE'=>$faker->randomElement(['O negativo','O positivo','A negativo','A positivo','B negativo','B positivo','AB negativo','AB positivo']),
            'EST_CORREO'=>$faker->email,
            'EST_DIRECCION'=>$faker->city(),
            'EST_NUMERO'=>$faker->numberBetween(100000000,200000000),
            'EST_CELULAR'=>$faker->numberBetween(1000000000,2000000000),
            'EST_CODIGO'=>$faker->numberBetween(1000,20000),
            'EST_MATRICULA'=>$faker->randomElement(['2019-2020','2020-2021']),
            'EST_INSCRITO'=>$faker->randomElement(['Si','No']),
            'EST_NROMATRICULA'=>$faker->numberBetween(1000,20000),
            'EST_RETIRADO'=>$faker->randomElement(['Si','No']),
            'EST_BECA'=>$faker->randomElement(['Si','No']),
            'course_id'=>$faker->numberBetween(1,100),
            'institution_id'=>$faker->numberBetween(1,100),
    ];
});
