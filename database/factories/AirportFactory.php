<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Airport::class, function (Faker $faker) {
    return [
        'icao' => strtoupper(str_random(4)),
        'iata' => strtoupper(str_random(3)),
        'name' => $faker->sentence(3),
        'city' => $faker->city,
        'country' => $faker->countryCode,
        'lat' => $faker->latitude,
        'long' => $faker->longitude,
        'elevation' => $faker->numberBetween(-100, 4000),
        'timezone' => $faker->timezone,
    ];
});
