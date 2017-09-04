<?php

namespace App\Filters;

class AirportFilters extends Filters
{
	public function filterByName(string $name)
	{
		return $this->query->where('name', 'like', "%$name");
	}

	public function filterByCity(string $city)
	{
		return $this->query->where('city', 'like', "%$city");
	}

	public function filterByCountryCode(string $code)
	{		
		return $this->query->whereCountry($code);
	}

	/*public function filterByCountryName(string $name, GeoRepository $geo)
	{
		if ($code = $geo->getCountryName($name)) {
			return $this->filterByCountryCode($code);
		}	

		return;
	}*/
}