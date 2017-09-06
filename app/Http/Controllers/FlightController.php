<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use App\Filters\FlightFilters;
use App\Http\Resources\FlightResource;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FlightFilters $filters)
    {
        $flights = Flight::with('origin', 'destination')
            ->apply($filters)->orderBy('number')->paginate(15);

        return FlightResource::collection($flights);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function show(Flight $flight)
    {
        $flight->load('origin', 'destination');

        return new FlightResource($flight);
    }
}
