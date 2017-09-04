<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\{Flight, Trip};
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TripTest extends TestCase
{
	use RefreshDatabase;

	public function testItHasManyFlights()
	{
		// Given
		$trip = factory(Trip::class)->create();
		$flight = factory(Flight::class)->create();

		// When
		$trip->flights()->attach($flight->id, ['index' => 1]);

		// Then
		$this->assertInstanceOf(Collection::class, $trip->flights);
		$this->assertInstanceOf(Flight::class, $trip->flights->first());
	}

	public function testItAddsFlight()
	{
		// Given
		$trip = factory(Trip::class)->create();
		$flight = factory(Flight::class)->make();

		// When
		$trip->addFlight($flight);

		// Then
		$this->assertNotEmpty($tripFlight = $trip->flights->first());
		$this->assertEquals($tripFlight->number, $flight->number);
		$this->assertEquals($tripFlight->pivot->index, 1);
	}

	public function testItAddsFlightsSequentiallyByIndex()
	{
		// Given
		$trip = factory(Trip::class)->create();
		$flights = factory(Flight::class, 5)->make();

		// When
		$flights->each(function($flight) use ($trip) {
			$trip->addFlight($flight);
		});

		// Then
		for($i = 1; $i <= 5; $i++) {
			$this->assertEquals($trip->flights->find($i)->pivot->index, $i);
		}
	}

	public function testItChecksForFlightExistence()
	{
		// Given
		$trip = factory(Trip::class)->create();
		$flight = factory(Flight::class)->make();

		// When
		$trip->addFlight($flight);

		// Then
		$this->assertTrue($trip->hasFlight($flight));
		$this->assertFalse($trip->hasFlight(
			factory(Flight::class)->create()
		));
	}

	public function testItDetachesFlightsFromTrip()
	{
		// Given
		$trip = factory(Trip::class)->create();
		$flights = factory(Flight::class, 2)->make();

		$flights->each(function($flight) use ($trip) {
			$trip->addFlight($flight);
		});

		list($flightOne, $flightTwo) = $flights;

		// When
		$trip->deleteFlight($flightOne);

		// Then
		$this->assertFalse($trip->hasFlight($flightOne));
		$this->assertTrue($trip->hasFlight($flightTwo));
		
		$this->assertDatabaseMissing('flight_trip', [
			'flight_id' => $flightOne->id,
			'trip_id' => $trip->id
		]);
		$this->assertDatabaseHas('flights', [
			'id' => $flightOne->id
		]);
	}

    public function testItDetachesFlightsWhenDeleted()
    {
        // Given
        $trip = factory(Trip::class)->create();
        $flights = factory(Flight::class, 5)->make();

        $flights->each(function($flight) use ($trip) {
        	$trip->addFlight($flight);
        });

        // When
        $trip->delete(); 

        // Then
        $this->assertDatabaseMissing('flight_trip', [
        	'trip_id' => $trip->id
        ]);
        $this->assertDatabaseHas('flights', [
        	'id' => $flights->random()->id
        ]);
    }
}
