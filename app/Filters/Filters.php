<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
	protected $request;

	protected $query;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function applyTo($query)
	{
		$this->query = $query;

		foreach($this->getQueryParams() as $key => $value) {
			$method = $this->getFilterMethod($key);

			if ($method) {
				$this->$method($value);
			}
		}

		return $query;
	}

	protected function getQueryParams()
	{
		return $this->request->query->all();
	}

	protected function getFilterMethod(string $filter)
	{
		$method = 'filterBy'.ucfirst($filter);

		if (! method_exists($this, $method)) {
			return;
		}

		return $method;
	}
}