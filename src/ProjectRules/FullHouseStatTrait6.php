<?php

namespace App\ProjectRules;

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
