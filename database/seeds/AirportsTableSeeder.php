<?php

use Carbon\Carbon;
use App\Models\Airport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class AirportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Airport::truncate();

    	$airportsRaw = json_decode(Storage::get('store/airports.json'), true);
    	$airports = [];
    	$timestamp = Carbon::now()->toDateTimeString();

    	foreach($airportsRaw as $airport) {
    		$airports[] = [
	    		'icao' => $airport['icao'],
	    		'iata' => $airport['iata'] !== '' ? $airport['iata'] : null,
	    		'name' => $airport['name'],
	    		'city' => $airport['city'],
	    		'country' => $airport['country'],
	    		'lat' => $airport['lat'],
	    		'long' => $airport['lon'],
	    		'elevation' => $airport['elevation'],
	    		'timezone' => $airport['tz'],
	    		'created_at' => $timestamp,
	    		'updated_at' => $timestamp,
    		];
    	}

    	foreach(array_chunk($airports, 1000) as $batch) {
    		Airport::insert($batch);
    	}
    }
}
