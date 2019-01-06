<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'user_name'=> $faker->name,
        'password'=>'123',
        'auto_password'=>$faker->randomElement($array = array (true,false)),
        'email'=> $faker->freeEmail   
    ];
});
