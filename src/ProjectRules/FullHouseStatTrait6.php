<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

trait FullHouseStatTrait6
{
    /**
     * @param array<int,int> $ranksHand
     */
    private function subCheck2($ranksHand): bool
    {
        return count($ranksHand) <= 2 && max($ranksHand) <= 3;
    }
}
