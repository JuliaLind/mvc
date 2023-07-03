<?php

namespace App\ProjectRules;

trait CountSuitAndRankTrait
{
    use SubCountTrait;

    /**
     * Used in the following traits:
     * RoyalFlushScoredTrait,
     * RoyalFLushTrait,
     * StraightFlushScoredTrait,
     *
     * Returns an associative array containing two
     * associative arrays. The keys of the first array
     * are the ranks present in the cards and the
     * values are the count of each ranks. The second
     * array contains correspoing data for the suits
     * present in the cards.
     * @param array<string> $cards
     * @return  array<string,array<array<int|string,int>>>
     */
    private function countSuitAndRank($cards): array
    {
        $ranks = [];
        $suits = [];
        foreach($cards as $card) {
            $ranks = $this->subCount(intval(substr($card, 0, -1)), $ranks);
            $suits = $this->subCount($card[-1], $suits);
        }
        return [
            'ranks' => $ranks,
            'suits' => $suits,
        ];
    }
}
