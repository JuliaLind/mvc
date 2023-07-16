<?php

namespace App\ProjectRules;

/**
 * Trait for searching for a specific card in
 * an array of cards. Used in the logic of Royal Flush rule.
 *  From kmom10/Project
 */
trait SearchSpecificCardTrait
{
    /**
     * Used in RoyalFlushTrait3
     *
     * Searches for a specific card card in a card array. Rank and suit of the card are passed as parameters, as well as the array of cards to search in
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
