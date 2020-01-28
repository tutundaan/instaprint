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
            "discipline" => $this->discipline,
            "teamwork" => $this->teamwork,
            "speed" => $this->speed,
            "skill" => $this->skill,
            "accuracy" => $this->accuracy,
            "evaluate" => $this->evaluate,
        ];
    }
}
