<?php

namespace App\Observers;

use App\Recomendation;

class RecomendationObserver
{
    public function creating(Recomendation $recomendation)
    {
        $recomendation->status = Recomendation::PENDING;
    }
}
