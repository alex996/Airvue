<?php

namespace App\Models\Concerns;

trait Filterable
{
	/**
	 * Applies filters to a query.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeApply($query, $filters)
	{
	    return $filters->applyTo($query);
	}
}