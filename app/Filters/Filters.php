<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
	protected $request;

	protected $query;

	protected $filterabe;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function applyTo($query)
	{
		$this->query = $query;

		foreach($this->getFilters() as $filter => $value)
		{
			if (method_exists($this, $method = camel_case($filter))) {
				$this->$method($value);
			}
		}

		return $query;
	}

	protected function getFilters()
	{
		return $this->request->only($this->filterabe);
	}
}