<?php

use App\Post;
use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'post_id' => function(){
            return Post::all()->random(); 
        },
        'name' => $faker->name,
        'description' => $faker->paragraph,
    ];
});
