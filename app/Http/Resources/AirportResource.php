<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AirportResource extends Resource
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
            'icao' => $this->icao,
            'iata' => $this->iata,
            'name' => $this->name,
            'city' => $this->city,
            'country' => $this->country,
            'lat' => (float) $this->lat,
            'long' => (float) $this->long,
            'elevation' => (int) $this->elevation,
            'timezone' => $this->timezone,
        ];
    }
}
