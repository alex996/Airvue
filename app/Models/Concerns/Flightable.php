<?php

namespace App\Models\Concerns;

use App\Models\Flight;

trait Flightable
{
	public function flights()
	{
		return $this->belongsToMany(Flight::class)
			->withPivot('index')
			->withTimestamps();
	}

	public function addFlight(Flight $flight)
	{
		return $this->flights()->save($flight, [
			'index' => $this->flights()->count() + 1
		]);
	}

	public function hasFlight(Flight $flight)
	{
		return $this->flights()->whereFlightId($flight->id)->exists();
	}

	public function deleteFlight(Flight $flight)
	{
	    return $this->flights()->detach($flight->id);
	}
}