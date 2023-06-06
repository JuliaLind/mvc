<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\CardSearcher;
use App\ProjectCard\Card;

class StraightStat extends StraightFlushStat
{
    protected int $uniqueSuits = 4;

    /**
     * @param array<Card> $cards
     */
    protected function checkAllPossible($cards): bool
    {
        $possible = false;
        foreach(['C', 'D', 'H', 'S'] as $suit) {
            $this->suit = $suit;
            $possible = parent::checkAllPossible($cards);
            if ($possible === true) {
                return $possible;
            }
        }
        return $possible;
    }
}
