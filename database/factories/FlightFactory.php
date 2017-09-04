<?php

use Carbon\Carbon;
use Faker\Generator as Faker;
use App\Models\{Airport, Flight};

$factory->define(Flight::class, function (Faker $faker) {
	$departedAt = Carbon::instance($faker->dateTimeBetween(
		Carbon::now()->toDateTimeString(),
		Carbon::now()->addMonth()->toDateTimeString()
	));

	$hours = $faker->numberBetween(1, 12);
	$minutes = $faker->numberBetween(1, 59);

    return [
        'origin_id' => function () {
            return factory(Airport::class)->create()->id;
        },
        'destination_id' => function () {
            return factory(Airport::class)->create()->id;
        },
        'airline' => ucfirst($faker->word),
        'departed_at' => $departedAt->toDateTimeString(),
        'arrived_at' => $departedAt->addHours($hours)->addMinutes($minutes)->toDateTimeString(),
        'hours' => $hours,
        'minutes' => $minutes
    ];
});
