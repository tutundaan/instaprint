<?php

namespace App\Observers;

use App\Failure;

class FailureObserver
{
    /**
     * Handle the failure "created" event.
     *
     * @param  \App\Failure  $failure
     * @return void
     */
    public function created(Failure $failure)
    {
        if ($sum <= 5) {
            $failure->score += 50;
        } else if ($sum > 5 and $sum <= 10) {
            $failure->score += 100;
        } else if ($sum > 10) {
            $failure->score += 200;
        }

        $failure->save();
    }

    /**
     * Handle the failure "updated" event.
     *
     * @param  \App\Failure  $failure
     * @return void
     */
    public function updated(Failure $failure)
    {
        //
    }

    /**
     * Handle the failure "deleted" event.
     *
     * @param  \App\Failure  $failure
     * @return void
     */
    public function deleted(Failure $failure)
    {
        //
    }

    /**
     * Handle the failure "restored" event.
     *
     * @param  \App\Failure  $failure
     * @return void
     */
    public function restored(Failure $failure)
    {
        //
    }

    /**
     * Handle the failure "force deleted" event.
     *
     * @param  \App\Failure  $failure
     * @return void
     */
    public function forceDeleted(Failure $failure)
    {
        //
    }
}
