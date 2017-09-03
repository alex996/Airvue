<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Airports
Route::apiResource('airports', 'AirportController')->only(['index', 'show']);

// Flights
Route::apiResource('flights', 'FlightController')->only(['index', 'show']);

// Trips
Route::apiResource('trips', 'TripController')->only(['store', 'show', 'destroy']);

// Flight Trips
Route::post('trips/{trip}/flights/{flight}', 'FlightTripController@store')->name('trips.flights.store');
Route::apiResource('trips/{trip}/flights', 'FlightTripController', ['as' => 'trips'])->only(['index', 'destroy']);
