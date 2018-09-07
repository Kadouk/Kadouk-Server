<?php

use Faker\Generator as Faker;

$factory->define(App\ContentImage::class, function (Faker $faker) {
    return [
        'path' => str_random(10),
        'content_id' => rand(1, 30),
    ];
});
