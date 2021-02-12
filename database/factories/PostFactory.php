<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

    $categoryIDs = DB::table('categories')->pluck('id');
    $userIDs = DB::table('users')->pluck('id');
    
    return [
        'category_id'=> $faker->randomElement($categoryIDs),
        'title'=> $faker->sentence(),
        'image_path' => $faker->imageUrl(),
        'user_id'=>$faker->randomElement($userIDs),
    ];
});
