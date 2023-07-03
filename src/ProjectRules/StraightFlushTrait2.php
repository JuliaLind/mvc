<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait StraightFlushTrait2
{
    private int $maxRank;
    private int $minRank;
    private string $suit;
    /**
     * @param array<string> $cards,
     * @param int $rank
     * @param string $suit
     */
    abstract private function searchSpecificCard(array $cards, int $rank, string $suit): bool;

    /**
     * Userd in the following traits:
     * RoyalFlushTrait,
     * RoyalFlushTrait2,
     * StraightTrait2
     * 
     * 
     * @param array<string> $cards
     */
    private function checkForCards(array $cards, int $minRank, string $suit): bool
    {
        $maxRank = $minRank + 4;

        for ($rank = $minRank; $rank <= $maxRank; $rank++) {
            if (!($this->searchSpecificCard($cards, $rank, $suit))) {
                return false;
            }
        }
        return true;
    }
}
