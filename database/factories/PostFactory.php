<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return User::all()->random(); 
        },
        'title' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'detail' => $faker->paragraph,
    ];
});
