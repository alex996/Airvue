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
        $response = $this->postJson(route('trips.flights.store', compact('trip', 'flight')));

        // Then
        $response->assertStatus(201)
        	->assertJsonStructure([
        		'data' => [
                    'number', 'origin', 'destination', 'airline', 'departed_at', 'arrived_at', 'hours', 'minutes'     			
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
    	$response = $this->postJson(route('trips.flights.store', compact('trip', 'flight')));

    	// Then
    	$response->assertStatus(400);

    	$this->assertDatabaseMissing('flight_trip', [
    		'flight_id' => $flight->id,
    		'trip_id' => $trip->id,
    		'index' => 2
    	]);
    }

    public function testItReturnsFlightsForTrip()
    {
        // Given
        $flight = factory(Flight::class)->create();
        $trip = factory(Trip::class)->create();
        $trip->addFlight($flight);

        // When
        $response = $this->getJson(route('trips.flights.index', compact('trip')));

        // Then
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'number', 'origin', 'destination', 'airline', 'departed_at', 'arrived_at', 'hours', 'minutes'
                    ]
                ]
            ])
            ->assertJsonFragment([
                'number' => $flight->number
            ]);
    }

    public function testItDetachesFlightsFromTrip()
    {
        // Given
        $trip = factory(Trip::class)->create();
        $flight = factory(Flight::class)->make();
        $trip->addFlight($flight);

        // When
        $response = $this->deleteJson(route('trips.flights.destroy', compact('trip', 'flight')));

        // Then
        $response->assertStatus(204);
    }
}
