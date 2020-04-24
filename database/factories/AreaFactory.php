<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Area;
use Faker\Generator as Faker;

$factory->define(Area::class, function (Faker $faker) {
    return [
        //
        'ARE_NOMBRE'=>$faker->randomElement(['Dirección General',
            'Administración de Mercadotecnia',
            'Ventas',
            'Publicidad y Promoción',
            'Investigación de Mercados',
            'Nuevos Mercados','Distribución']),
        'ARE_DESCRIPCCION'=>$faker->text(100),

    ];
});
