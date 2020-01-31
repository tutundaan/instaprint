<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Rating extends JsonResource
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
            "discipline" => ($this->discipline ?? 0),
            "teamwork" => ($this->teamwork ?? 0),
            "speed" => ($this->speed ?? 0),
            "skill" => ($this->skill ?? 0),
            "accuracy" => ($this->accuracy ?? 0),
            "evaluate" => ($this->evaluate ?? 0),
        ];
    }
}
