<?php

use Carbon\Carbon;
use Faker\Generator as Faker;
use App\Models\{Airport, Flight};

$factory->define(Flight::class, function (Faker $faker) {
	
	list($originId, $destinationId) = Airport::inRandomOrder()->take(2)->pluck('id');

	$departedAt = Carbon::instance($faker->dateTimeBetween(
		Carbon::now()->toDateTimeString(),
		Carbon::now()->addYear()->toDateTimeString()
	));

	$hours = $faker->numberBetween(1, 12);
	$minutes = $faker->numberBetween(1, 59);

    return [
        'origin_id' => $originId,
        'destination_id' => $destinationId,
        'departed_at' => $departedAt->toDateTimeString(),
        'arrived_at' => $departedAt->addHours($hours)->addMinutes($minutes)->toDateTimeString(),
        'hours' => $hours,
        'minutes' => $minutes
    ];
});
