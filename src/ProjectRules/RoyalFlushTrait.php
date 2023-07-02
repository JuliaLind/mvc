<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait RoyalFlushTrait
{
    /**
     * @param array<string> $cards
     * @return  array<string,array<array<int|string,int>>>
     */
    abstract private function countSuitAndRank($cards): array;
    /**
     * @param array<string> $cards
     */
    abstract private function checkForCards($cards, int $minRank, string $suit): bool;

    /**
     * @param array<string> $hand
     * @param array<string> $deck
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
