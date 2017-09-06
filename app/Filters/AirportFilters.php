<?php

namespace App\Filters;

use Illuminate\Http\Request;

class AirportFilters extends Filters
{
	/**
	 * The query string parameters that should act as filters.
	 * 
	 * @var array
	 */
	protected $filterabe = [
		'name', 'city', 'country'
	];

	/**
	 * Filter airports by name.
	 * 
	 * @param  string $name
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function name(string $name)
	{
		return $this->query->where('name', 'like', "%$name%");
	}

	/**
	 * Filter airports by city.
	 * 
	 * @param  string $city
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function city(string $city)
	{
		return $this->query->where('city', 'like', "%$city%");
	}

	/**
	 * Filter airports by country code.
	 * 
	 * @param  string $country
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function country(string $country)
	{		
		return $this->query->whereCountry($country);
	}
}