<?php

namespace App\ProjectRules;

trait GroupBySuitTrait
{
    /**
     * Used in the following traits:
     * StraightFlushTrait,
     * RoyalFlushTrait2
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
        $data = [
            'D' => [],
            'H' => [],
            'C' => [],
            'S' => []
        ];
        foreach($cards as $card) {
            $data[$card[-1]][] = intval(substr($card, 0, -1));
        }
        return $data;
    }
}
