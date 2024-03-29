<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for checking if Royal Flush Rule is possible to achieve without the dealt card,
 * in a partially filled hand.
 * From kmom10/Project
 */
trait RoyalFlushTrait
{
    use RoyalFlushTrait3;

    /**
     * From CountSuitAndRankTrait
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
    abstract private function countSuitAndRank($cards): array;


    /**
     * Returns true if the RoyalFlush rule is possible to score without the dealt card
     * @param array<string> $hand
     * @param array<string> $deck - cards from the deck that will be dealt to the player in the remaining game
     */
    public function possibleWithoutCard(array $hand, array $deck): bool
    {
        $uniqueCount = $this->countSuitAndRank($hand);
        /**
         * @var array<string,int> $suits
         */
        $suits = $uniqueCount['suits'];
        /**
         * @var array<int,int> $ranks
         */
        $ranks = $uniqueCount['ranks'];

        $allCards = array_merge($hand, $deck);

        return count($suits) === 1 && min(array_keys($ranks)) >= 10 && $this->checkForCards($allCards, 10, array_key_first($suits));
    }
}
