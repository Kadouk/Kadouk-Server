<?php

use Faker\Generator as Faker;

$factory->define(App\Content::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'desc' => 'desc',
        'publisher_id' => rand(1, 2), // secret
        'catagory_id' => rand(1, 1),
    ];
});
