<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Flight, Trip};
use App\Http\Resources\TripResource;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FlightTripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Trip $trip)
    {
        $trip->load('flights');

        return new TripResource($trip);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Trip $trip, Flight $flight)
    {
        if ($trip->hasFlight($flight)) {
            throw new BadRequestHttpException("Flight #{$flight->number} has already been added to the trip.");
        }

        $trip->addFlight($flight);

        $trip->load('flights');

        return (new TripResource($trip))
            ->response()
            ->setStatusCode(201);
    }
}
