<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Totourial;

class TotourialObserver
{
    /**
     * Handle the Totourial "created" event.
     *
     * @param  \App\Models\Totourial  $totourial
     * @return void
     */
    public function created(Totourial $totourial)
    {
        $totourial->createActive("create_without_task_$totourial->id", $totourial->id);
    }

    /**
     * Handle the Totourial "updated" event.
     *
     * @param  \App\Models\Totourial  $totourial
     * @return void
     */
    public function updated(Totourial $totourial)
    {
        Activity::create([
            'title' => 'create_2',
            'totourial_id' => $totourial->id
        ]);
    }

    /**
     * Handle the Totourial "deleted" event.
     *
     * @param  \App\Models\Totourial  $totourial
     * @return void
     */
    public function deleted(Totourial $totourial)
    {
        //
    }

    /**
     * Handle the Totourial "restored" event.
     *
     * @param  \App\Models\Totourial  $totourial
     * @return void
     */
    public function restored(Totourial $totourial)
    {
        //
    }

    /**
     * Handle the Totourial "force deleted" event.
     *
     * @param  \App\Models\Totourial  $totourial
     * @return void
     */
    public function forceDeleted(Totourial $totourial)
    {
        //
    }
}
