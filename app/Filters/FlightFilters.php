<?php

namespace App\Filters;

class FlightFilters extends Filters
{
	/**
	 * The query string parameters that should act as filters.
	 * 
	 * @var array
	 */
	protected $filterabe = [
		'from', 'to', 'date', 'airline'
	];

	/**
	 * Filter flights by origin city and (optionally) country code.
	 * 
	 * @param  string $origin
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function from(string $origin)
	{
		return $this->airport($origin, 'origin');
	}

	/**
	 * Filter flights by destination city and (optionally) country code.
	 * 
	 * @param  string $destination
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function to(string $destination)
	{
		return $this->airport($destination, 'destination');
	}
	
	/**
	 * Filter flights by departure date.
	 * 
	 * @param  string $departedAt
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function date(string $departedAt)
	{
		return $this->query->whereDate('departed_at', $departedAt);
	}

	/**
	 * Filter flights by airline carrier.
	 * 
	 * @param  string $airline
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function airline(string $airline)
	{
		return $this->query->whereAirline($airline);
	}
	
	/**
	 * Filter flights by city and (optionally) country code using a given relation.
	 * 
	 * @param  string $cityAndCountry
	 * @param  string $relation
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
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