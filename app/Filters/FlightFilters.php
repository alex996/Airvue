<?php

namespace App\Filters;

class FlightFilters extends Filters
{
	protected $filterabe = [
		'from', 'to', 'date', 'airline'
	];

	public function from(string $origin)
	{
		return $this->airport($origin, 'origin');
	}

	public function to(string $destination)
	{
		return $this->airport($destination, 'destination');
	}
	
	public function date(string $departedAt)
	{
		return $this->query->whereDate('departed_at', $departedAt);
	}

	public function airline(string $airline)
	{
		return $this->query->whereAirline($airline);
	}

	protected function airport(string $cityAndCountry, string $relation)
	{
		list($city, $country) = array_pad(explode(',', $cityAndCountry), 2, null);

		return $this->query->whereHas($relation, function($query) use ($city, $country) {
			$query->where('city', 'like', '%'.trim($city).'%');

			if ($country) {
				$query->whereCountry(trim($country));
			}
		});
	}
}