<?php

namespace App\Filters;

use Illuminate\Http\Request;

class FlightFilters
{
	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function applyTo($query)
	{
		return $query;
	}
}