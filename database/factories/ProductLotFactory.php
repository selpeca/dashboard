<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ProductLot::class, function (Faker $faker) {
    return [
        'product_id'=>App\Models\Product::all()->random()->id,
        'precio_lote'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 9999999),
        'precio_unitario'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 9999999),
        'cantidad'=>$faker->numberBetween($min = 10, $max = 110)
    ];
});
