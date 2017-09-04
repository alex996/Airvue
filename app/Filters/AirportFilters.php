<?php

namespace App\Filters;

use Illuminate\Http\Request;

class AirportFilters extends Filters
{
	protected $filterabe = [
		'name', 'city', 'country'
	];

	public function name(string $name)
	{
		return $this->query->where('name', 'like', "%$name");
	}

	public function city(string $city)
	{
		return $this->query->where('city', 'like', "%$city");
	}

	public function country(string $country)
	{		
		return $this->query->whereCountry($country);
	}
}