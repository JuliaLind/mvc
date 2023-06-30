<?php

namespace App\ProjectRules;

trait FullHouseStatTrait8
{
    /**
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck3($ranksHand, $ranksDeck): bool
    {
        return count($ranksHand) === 1 && ((max($ranksHand) === 2 && max($ranksDeck) >= 3) || (max($ranksHand) === 3 && max($ranksDeck) >= 2));
    }
}
