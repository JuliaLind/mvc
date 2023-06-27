<?php

namespace App\ProjectRules;

trait TwoPairsStatTrait6
{
    /**
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck2(array $hand, int $rank, array $ranksHand, array $ranksDeck): bool
    {
        if (count($hand) === 1) {
            /**
             * @var int $maxRankDeck
             */
            $maxRankDeck = max($ranksDeck);
            if ((array_key_exists($rank, $ranksHand) && $maxRankDeck >= 2) || (array_key_exists($rank, $ranksDeck) && array_key_exists(array_keys($ranksHand)[0], $ranksDeck))) {
                return true;
            }
        }
        return false;
    }
}
