<?php

namespace App\Observers;

use App\Models\Matches;

class MatchObserver
{
    /**
     * Handle the Matches "created" event.
     *
     * @param  \App\Models\Matches  $matches
     * @return void
     */
    public function created(Matches $matches)
    {
        //
    }

    /**
     * Handle the Matches "updated" event.
     *
     * @param  \App\Models\Matches  $matches
     * @return void
     */
    public function updated(Matches $matches)
    {
        dd($matches);
        $goalsTeamA = $matches->goalsTeamA;
        $goalsTeamB = $matches->goalsTeamB;

        if ($goalsTeamA > $goalsTeamB) {
            $matches->result = 'TeamA';
            $matches->teamA->points += 3;
        } elseif ($goalsTeamB > $goalsTeamA) {
            $matches->result = 'TeamB';
            $matches->teamB->points += 3;
        } else {
            $matches->result = 'Draw';
            $matches->teamA->points += 1;
            $matches->teamB->points += 1;
        }

        $matches->teamA->save();
        $matches->teamB->save();

        $matches->updateQuietly();
    }

    /**
     * Handle the Matches "deleted" event.
     *
     * @param  \App\Models\Matches  $matches
     * @return void
     */
    public function deleted(Matches $matches)
    {
        //
    }

    /**
     * Handle the Matches "restored" event.
     *
     * @param  \App\Models\Matches  $matches
     * @return void
     */
    public function restored(Matches $matches)
    {
        //
    }

    /**
     * Handle the Matches "force deleted" event.
     *
     * @param  \App\Models\Matches  $matches
     * @return void
     */
    public function forceDeleted(Matches $matches)
    {
        //
    }
}
