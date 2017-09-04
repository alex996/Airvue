<?php

namespace App\Filters;

class FlightFilters extends Filters
{
	public function filterByAirline(string $airline)
	{
		return $this->query->whereAirline($airline);
	}
}