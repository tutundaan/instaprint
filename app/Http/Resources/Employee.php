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
            "code" =>  $this->number,
            "name" =>  $this->formattedName(),
            "phone" =>  $this->user->phone ?? null,
            "rating" =>  new Rating($this->lastRating()),
            "failures" =>  Failure::collection($this->failures),
            "failure_range_link" => $this->failureRangeLink(),
            "attendances" =>  Attendance::collection($this->attendances()
                ->where('duplicated', false)
                ->where('show_in_current_date', true)
                ->orderBy('recorded_at', 'asc')
                ->orderBy('recorded_time', 'asc')
                ->get()),
            "attendance_range_link" => $this->attendanceRangeLink(),
            "user" => new User($this->user),
        ];
    }
}
