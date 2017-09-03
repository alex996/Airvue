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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'hours' => 'integer',
        'minutes' => 'integer'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * Whenever a Flight instance is created, assign a number to it.
         */
        static::creating(function($flight) {
            $flight->number = strtoupper(str_random(6));
        });
    }

    public function origin()
    {
    	return $this->belongsTo(Airport::class, 'origin_id');
    }

    public function destination()
    {
    	return $this->belongsTo(Airport::class, 'destination_id');
    }
}
