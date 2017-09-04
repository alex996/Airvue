<?php

namespace App\Filters;

use Illuminate\Http\Request;
//use App\Repositories\GeoRepository;

class AirportFilters extends Filters
{
	/*public function __construct(Request $request, GeoRepository $geo)
	{
		parent::__construct($request);

		$this->geo = $geo;
	}*/

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

	/*public function filterByCountryName(string $name)
	{
		if ($code = $this->geo->getCountryName($name)) {
			return $this->filterByCountryCode($code);
		}	

		return;
	}*/
}