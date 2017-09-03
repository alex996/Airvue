<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\{Flight, Trip};
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlightTripTest extends TestCase
{
	use RefreshDatabase;

    public function testItAddsFlightToTrip()
    {
        // Given
        $flight = factory(Flight::class)->create();
        $trip = factory(Trip::class)->create();

        // When
        $response = $this->postJson(route('flight-trips.store', compact('trip', 'flight')), []);

        // Then
        $response->assertStatus(201)
        	->assertJsonStructure([
        		'data' => [
        			'uid', 'flights'
        		]
        	])
        	->assertJsonFragment([
        		'number' => $flight->number
        	]);

        $this->assertDatabaseHas('flight_trip', [
        	'flight_id' => $flight->id,
        	'trip_id' => $trip->id,
        	'index' => 1
        ]);
    }

    public function testItDoesNotAddFlightToTripTwice()
    {
    	// Given
    	$flight = factory(Flight::class)->create();
    	$trip = factory(Trip::class)->create();
    	$trip->addFlight($flight);

    	// When
    	$response = $this->postJson(route('flight-trips.store', compact('trip', 'flight')), []);

    	// Then
    	$response->assertStatus(400);

    	$this->assertDatabaseMissing('flight_trip', [
    		'flight_id' => $flight->id,
    		'trip_id' => $trip->id,
    		'index' => 2
    	]);
    }
}
