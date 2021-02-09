<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

    $categoryIDs = DB::table('categories')->pluck('id');
    
    return [
        'category_id'=> $faker->randomElement($categoryIDs),
        'title'=> $faker->sentence(),
        'author'=>$faker->name,
    ];
});
