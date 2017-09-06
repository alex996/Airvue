<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
	/**
	 * Request instance.
	 * 
	 * @var \Illuminate\Http\Request
	 */
	protected $request;

	/**
	 * Query builder instance.
	 * 
	 * @var \Illuminate\Database\Eloquent\Builder
	 */
	protected $query;

	/**
	 * The query string parameters that should act as filters.
	 * 
	 * @var array
	 */
	protected $filterabe;

	/**
	 * Create a new filters instance.
	 * 
	 * @param Request $request
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Apply filters to a query builder instance.
	 * 
	 * @param  \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
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

	/**
	 * Extract filterable attributes off the request instance.
	 * 
	 * @return array
	 */
	protected function getFilters()
	{
		return $this->request->only($this->filterabe);
	}
}