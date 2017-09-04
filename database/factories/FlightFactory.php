<?php

use Carbon\Carbon;
use Faker\Generator as Faker;
use App\Models\{Airport, Flight};

$factory->define(Flight::class, function (Faker $faker) {
	static $origin_id;
	static $destination_id;

	$departedAt = Carbon::instance($faker->dateTimeBetween(
		Carbon::now()->toDateTimeString(),
		Carbon::now()->addYear()->toDateTimeString()
	));

	$hours = $faker->numberBetween(1, 12);
	$minutes = $faker->numberBetween(1, 59);

    return [
        'origin_id' => $origin_id ?: factory(Airport::class)->create()->id,
        'destination_id' => $destination_id ?: factory(Airport::class)->create()->id,
        'airline' => ucfirst($faker->word),
        'departed_at' => $departedAt->toDateTimeString(),
        'arrived_at' => $departedAt->addHours($hours)->addMinutes($minutes)->toDateTimeString(),
        'hours' => $hours,
        'minutes' => $minutes
    ];
});
