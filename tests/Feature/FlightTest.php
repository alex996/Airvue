<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\{Airport, Flight};
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlightTest extends TestCase
{
	use RefreshDatabase;

    public function testItReturnsFlightById()
    {
        // Given
        $airports = factory(Airport::class, 2)->create();

        $flight = factory(Flight::class)->create([
        	'origin_id' => $airports->first()->id,
        	'destination_id' => $airports->last()->id
        ]);

        // When
        $response = $this->getJson(route('flights.show', $flight));

        // Then
        $response->assertStatus(200)
        	->assertJsonStructure([
        		'data' => [
        			'origin', 'destination', 'departed_at', 'arrived_at', 'hours', 'minutes'
        		]
        	]);
    }
}
