<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

trait FullHouseStatTrait
{
    /**
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksAll
     */
    private function subCheck($ranksHand, $ranksAll): bool
    {
        $three = false;
        $two = false;
        foreach (array_keys($ranksHand) as $rank) {
            if ($three === false && $ranksAll[$rank] >= 3) {
                $three = true;
            } elseif ($ranksAll[$rank] >= 2) {
                $two = true;
            }
            if ($three && $two) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param array<int,int> $ranksHand
     */
    private function subCheck2($ranksHand): bool
    {
        return count($ranksHand) <= 2 && max($ranksHand) <= 3;
    }

    /**
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck3($ranksHand, $ranksDeck): bool
    {
        return count($ranksHand) === 1 && ((max($ranksHand) === 2 && max($ranksDeck) >= 3) || (max($ranksHand) === 3 && max($ranksDeck) >= 2));
    }
}
