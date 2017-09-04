<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Flight, Trip};
use App\Http\Resources\FlightResource;
use Illuminate\Support\Facades\Response;
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
        return FlightResource::collection($trip->flights);
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

        return (new FlightResource($flight))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip, Flight $flight)
    {
        $trip->deleteFlight($flight);

        return Response::json([], 204);
    }
}
