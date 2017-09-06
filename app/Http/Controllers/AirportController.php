<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Http\Request;
use App\Filters\AirportFilters;
use App\Http\Resources\AirportResource;

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AirportFilters $filters)
    {
        $airports = Airport::orderBy('name')->apply($filters)->paginate(15);

        return AirportResource::collection($airports);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function show(Airport $airport)
    {
        return new AirportResource($airport);
    }
}
