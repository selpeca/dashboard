<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Client::class, function (Faker $faker) {
    return [
        'primer_nombre'=> $faker->firstName,
        'primer_apellido'=>$faker->lastName,
        'tip_id'=>$faker->randomElement($array = array ('CC','TI','TP','RC','CE','CI')),
        'num_id'=>$faker->creditCardNumber,
        'tel'=>$faker->tollFreePhoneNumber
        /*
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'nacimiento',
        'tip_id',['CC','TI','TP','RC','CE','CI'],
        'num_id',
        'tel'
        */
    ];
});
