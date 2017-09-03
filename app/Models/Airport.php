<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
	/**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
	protected $casts = [
		'lat' => 'float',
		'long' => 'float'
	];

	public function departures()
	{
		return $this->hasMany(Flight::class, 'origin_id');
	}

	public function arrivals()
	{
		return $this->hasMany(Flight::class, 'destination_id');
	}
}
