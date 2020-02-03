<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Attendance extends JsonResource
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
            "date" => $this->recorded_at,
            "jam" => $this->recorded_time,
            "type" => $this->type,
            "score" => $this->score,
            "type_label" => $this->typeLabel(),
            "additional_type" => $this->additional_type,
            "additional_type_label" => $this->additionalTypeLabel(),
            "additional_minutes" => $this->additional_minutes,
            "duplicated" => $this->duplicated,
            "show_in_current_date" => $this->show_in_current_date,
        ];
    }
}
