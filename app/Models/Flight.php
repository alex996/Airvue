<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
	protected $dates = [
		'departed_at', 'arrived_at'
	];

    public function origin()
    {
    	return $this->belongsTo(Airport::class, 'origin_id');
    }

    public function destination()
    {
    	return $this->belongsTo(Airport::class, 'destination_id');
    }
}
