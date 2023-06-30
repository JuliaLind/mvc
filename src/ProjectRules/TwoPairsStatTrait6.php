<?php

namespace App\ProjectRules;

trait TwoPairsStatTrait6
{
    /**
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function checkForTwoPairs1(int $rank, array $ranksHand, array $ranksDeck): bool
    {
        /**
         * @var int $maxRankDeck
         */
        $maxRankDeck = max($ranksDeck);
        return (array_key_exists($rank, $ranksHand) && $maxRankDeck >= 2);
    }

    /**
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function checkForTwoPairs2(int $rank, array $ranksHand, array $ranksDeck): bool
    {
        return array_key_exists($rank, $ranksDeck) && array_key_exists(array_keys($ranksHand)[0], $ranksDeck);
    }

    /**
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck2(array $hand, int $rank, array $ranksHand, array $ranksDeck): bool
    {
        return count($hand) === 1 && ($this->checkForTwoPairs1($rank, $ranksHand, $ranksDeck) || $this->checkForTwoPairs2($rank, $ranksHand, $ranksDeck));
    }
}
