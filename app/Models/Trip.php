<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    public function flights()
    {
    	return $this->belongsToMany(Flight::class)
    		->withPivot('index')
    		->withTimestamps();
    }

    public function addFlight($flight)
    {
    	$add = is_a($flight, Flight::class) ? 'save' : 'attach';

    	return $this->flights()->$add($flight, [
    		'index' => $this->flights()->count() + 1
    	]);
    }
}
