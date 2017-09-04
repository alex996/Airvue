<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Airport;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AirportTest extends TestCase
{
	use RefreshDatabase;
	
    public function testItPaginatesAirportsAlphabetically()
    {
        // Given
    	$airports = factory(Airport::class, 100)->create();

        // When
    	$response = $this->getJson(route('airports.index'));

        // Then
        $response->assertStatus(200)
        	->assertJsonStructure([
        		'data' => [
        			[
        				'icao', 'iata', 'name', 'city', 'country', 'lat', 'long', 'elevation', 'timezone'
        			]
        		]
        	]);

        $airports = json_decode($response->content(), 1)['data'];
        list($first, $second) = array_rand($airports, 2);

        $this->assertGreaterThan($airports[$first]['name'], $airports[$second]['name']);
    }

    public function testItReturnsAirportById()
    {
    	// Given
    	$airport = factory(Airport::class)->create();

    	// When
    	$response = $this->getJson(route('airports.show', $airport));

    	// Then
    	$response->assertStatus(200)
    		->assertJson([
                'data' => [
                    'icao' => $airport->icao,
                    'iata' => $airport->iata,
                    'name' => $airport->name,
                    'city' => $airport->city,
                    'country' => $airport->country,
                    'lat' => $airport->lat,
                    'long' => $airport->long,
                    'elevation' => $airport->elevation,
                    'timezone' => $airport->timezone,
                ]                
            ]);
    }
}
