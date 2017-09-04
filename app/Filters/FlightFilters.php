<?php

namespace App\Filters;

class FlightFilters extends Filters
{
	protected $filterabe = [
		'origin', 'destination', 'airline'
	];

	public function airline(string $airline)
	{
		return $this->query->whereAirline($airline);
	}
}