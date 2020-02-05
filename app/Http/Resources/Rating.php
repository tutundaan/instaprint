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
            "kedisiplinan" => ($this->discipline ?? 0),
            "kerjasama" => ($this->teamwork ?? 0),
            "kecepatan" => ($this->speed ?? 0),
            "kemampuan" => ($this->skill ?? 0),
            "ketelitian" => ($this->accuracy ?? 0),
            "evaluate" => ($this->evaluate ?? 0),
            "supervisor" => ($this->user ? $this->user->name : null),
            "created_at" => $this->createdAt()->format('F Y'),
        ];
    }
}
