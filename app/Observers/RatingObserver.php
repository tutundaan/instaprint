<?php

namespace App\Observers;

use App\Rating;

class RatingObserver
{

    public function creating(Rating $rating)
    {
        $rating->countSummary();
    }

    public function created(Rating $rating)
    {
    }

    public function updated(Rating $rating)
    {
    }

    public function deleted(Rating $rating)
    {
    }

    public function restored(Rating $rating)
    {
    }

    public function forceDeleted(Rating $rating)
    {
    }
}
