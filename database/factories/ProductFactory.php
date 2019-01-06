<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        /*
        'nombre',
        'stock_min',
        'descripcion'
        */
        'nombre'=>$faker->word,
        'stock_min'=>$faker->numberBetween($min = 10, $max = 150),
        'descripcion'=>$faker->text($maxNbChars = 90)
    ];
});
