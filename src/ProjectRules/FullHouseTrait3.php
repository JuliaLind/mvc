<?php

namespace App\ProjectRules;

/**
 * Trait for checking if a FullHouse rule is psosible to score wihtout the
 * dealt card, in an empty hand.
 * From kmom10/Project
 */
trait FullHouseTrait3
{
    /**
     * Returns an associative array
     * where keys are the ranks present amongst
     * the cards and the values are the count of
     * each rank
     * @param array<string> $cards
     * @return  array<array<int|string,int>>
     */
    abstract private function countByRank($cards): array;

    /**
     * Used in FullHouseTrait2
     *
     * Returns true if the deck contains at least
     * 3 cards of the same rank and at leat two cards
     * of same (other) rank
     * @param array<string> $deck - the cards from the deck that will be dealt to the player in the remaining game
     */
    public function possibleDeckOnly(array $deck): bool
    {
        /**
         * @var array<int,int> $ranks
         */
        $ranks = $this->countByRank($deck);

        $three = 0;
        $two = 0;

        foreach ($ranks as $countRank) {
            if ($three === 0 && $countRank >= 3) {
                $three = 1;
            } elseif ($countRank >= 2) {
                $two = 1;
            }
            if ($two + $three === 2) {
                return true;
            }
        }
        return false;
    }
}
