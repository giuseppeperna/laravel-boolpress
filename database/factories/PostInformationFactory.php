<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PostInformation;
use Faker\Generator as Faker;

$factory->define(PostInformation::class, function (Faker $faker) {

    $postIDs = DB::table('posts')->pluck('id');

    return [
        'post_id'=>$faker->unique()->randomElement($postIDs),
        'description'=>$faker->text(),
        'slug'=>$faker->slug,
    ];
});
