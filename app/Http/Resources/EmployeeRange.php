<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class EmployeeRange extends JsonResource
{

    private $start;
    private $end;

    public function __construct($resource, $start, $end)
    {
        parent::__construct($resource);
        $this->start = Carbon::parse($start);
        $this->end = Carbon::parse($end);
    }

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
            "failures" =>  Failure::collection($this->failures()
                ->whereBetween('created_at', [$this->start->startOfDay(), $this->end->endOfDay()])
                ->get()),
            "failure_range_link" => $this->failureRangeLink()
        ];
    }
}
