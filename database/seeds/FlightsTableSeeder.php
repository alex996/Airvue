<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\{Airport, Flight};

class FlightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Flight::truncate();

        $airlines = json_decode(Storage::get('store/airlines.json'), true);
        $cities = [
        	'Toronto', 'Montreal', 'Vancouver', 'Calgary', 'Ottawa',
        	'Edmonton', 'Quebec', 'Winnipeg', 'Hamilton', 'Kitchener'
        ];

        $airports = Airport::whereIn('city', $cities)->where('country', 'CA')->pluck('id')->toArray();
        $timestamp = Carbon::now()->toDateTimeString();

        for($i = 0; $i < 10; $i++) {
        	$flights = [];

        	for($j = 0; $j < 1000; $j++) {
        		$flights[] = factory(Flight::class)->raw([
        			'number' => strtoupper(str_random(6)),
        			'origin_id' => $airports[array_rand($airports)],
        			'destination_id' => $airports[array_rand($airports)],
        			'airline' => $airlines[array_rand($airlines)],
        			'created_at' => $timestamp,
        			'updated_at' => $timestamp,
        		]);
        	}

        	Flight::insert($flights);
        }
    }
}
