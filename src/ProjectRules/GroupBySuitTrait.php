<?php

namespace App\ProjectRules;

/**
 * Trait that for an array of cards returns an associative array where keys are suits and values are arrays with all ranks of that
 * suit that are present in the card array.
 * From kmom10/Project
 */
trait GroupBySuitTrait
{
    /**
     * Used in the following traits:
     * RoyalFlushTrait2,
     * StraightFlushTrait,
     * StraightFlushTrait3
     *
     * Returns an associative array with keys
     * correspoding to suits present in the cards
     * array and values - arrays containing the ranks
     * of each suit present in the card-array
     * @param array<string> $cards
     * @return array<string,array<int,int>>
     */
    private function groupBySuit($cards): array
    {
        $data = [];
        foreach($cards as $card) {
            $suit = $card[-1];
            $rank = intval(substr($card, 0, -1));
            if (!array_key_exists($suit, $data)) {
                $data[$suit] = [];
            }
            $data[$suit][] = $rank;
        }
        return $data;
    }
}
