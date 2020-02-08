<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Rank extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'number' => $this['number'],
            'name' => $this['name'],
            'attendances' => $this['attendances'],
            'failures' => $this['failures'],
            'rating' => $this['rating'],
            'period' => $this['period'],
            'ranges' => $this['ranges'],
        ];
    }
}
