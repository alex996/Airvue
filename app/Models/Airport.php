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

	/**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
	public function getRouteKey()
	{
		return $this->icao;
	}
	
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
    	return 'icao';
    }

	public function departures()
	{
		return $this->hasMany(Flight::class, 'origin_id');
	}

	public function arrivals()
	{
		return $this->hasMany(Flight::class, 'destination_id');
	}
}
