<?php

namespace App\ProjectRules;

trait SearchSpecificCardTrait
{
    /**
     * @param array<string> $cards,
     * @param int $rank
     * @param string $suit
     */
    private function searchSpecificCard(array $cards, int $rank, string $suit): bool
    {
        foreach($cards as $card) {
            if ($card === strval($rank).$suit) {
                return true;
            }
        }
        return false;
    }
}
