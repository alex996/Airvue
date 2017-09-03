<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	protected static function boot()
	{
	    parent::boot();

	    /**
	     * Whenever a Trip instance is being created, assign a uid to it.
	     */
	    static::creating(function($trip) {
	        $trip->uid = uniqid();
	    });

	    /**
	     * Whenever a Trip instance is being deleted, detach its flights.
	     */
	    static::deleting(function($trip) {
	    	$trip->flights()->detach();
	    });
	}

	/**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
	public function getRouteKey()
	{
		return $this->uid;
	}

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
    	return 'uid';
    }

    public function flights()
    {
    	return $this->belongsToMany(Flight::class)
    		->withPivot('index')
    		->withTimestamps();
    }

    public function addFlight(Flight $flight)
    {
    	return $this->flights()->save($flight, [
    		'index' => $this->flights()->count() + 1
    	]);
    }

    public function hasFlight(Flight $flight)
    {
    	return $this->flights()->whereFlightId($flight->id)->exists();
    }
}
