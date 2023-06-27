<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

trait FullHouseStatTrait
{
    abstract private function checkThree(bool $three, int $rank): bool;
    abstract private function checkBoth(bool $three, bool $two): bool;

    /**
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksAll
     */
    private function subCheck($ranksHand, $ranksAll): bool
    {
        $three = false;
        $two = false;
        foreach (array_keys($ranksHand) as $rank) {
            if ($this->checkThree($three, $ranksAll[$rank])) {
                $three = true;
            } elseif ($ranksAll[$rank] >= 2) {
                $two = true;
            }
            if ($this->checkBoth($three, $two)) {
                return true;
            }
        }
        return false;
    }
}
