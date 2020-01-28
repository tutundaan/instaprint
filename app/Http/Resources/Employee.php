<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Employee extends JsonResource
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
            "number" =>  $this->id,
            "name" =>  $this->formattedName(),
            "phone" =>  $this->user->phone ?? null,
            "rating" =>  new Rating($this->lastRating()),
        ];
    }
}
