<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class FlightResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'origin' => new AirportResource($this->origin),
            'destination' => new AirportResource($this->destination),
            'departed_at' => $this->departed_at,
            'arrived_at' => $this->arrived_at,
            'hours' => (int) $this->hours,
            'minutes' => (int) $this->minutes,
        ];
    }
}
