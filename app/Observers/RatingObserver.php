<?php

namespace App\Observers;

use App\Rating;
use Auth;

class RatingObserver
{

    public function creating(Rating $rating)
    {
        $rating->user_id = Auth::user()->id;
        $rating->countSummary();
    }

    public function created(Rating $rating)
    {
    }

    public function updating(Rating $rating)
    {
        $rating->countSummary();
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
