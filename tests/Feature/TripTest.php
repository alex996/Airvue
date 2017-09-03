<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\{Trip, Flight};
use Illuminate\Foundation\Testing\RefreshDatabase;

class TripTest extends TestCase
{
	use RefreshDatabase;

    public function testItStoresEmptyTripWithUid()
    {
        // When
        $response = $this->postJson(route('trips.store'), []);

        // Then
        $response->assertStatus(201)
        	->assertJsonStructure([
        		'data' => [
        			'uid', 'flights'
        		]
        	]);

        $uid = json_decode($response->content(), true)['data']['uid'];
        
       	$this->assertDatabaseHas('trips', compact('uid'));
    }

    public function testItReturnsTripWithFlightsById()
    {
        // Given
        $trip = factory(Trip::class)->create();
        $flight = factory(Flight::class)->create();
        $trip->addFlight($flight);

        // When
        $response = $this->getJson(route('trips.show', $trip));

        // Then
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'uid', 'flights'
                ]
            ])
            ->assertJsonFragment([
                'number' => $flight->number
            ]);
    }
}
