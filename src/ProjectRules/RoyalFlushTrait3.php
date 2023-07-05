<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait RoyalFlushTrait3
{
    use SearchSpecificCardTrait;

    private int $maxRank;
    private int $minRank;
    private string $suit;

    /**
     * Userd in the following traits:
     * RoyalFlushTrait,
     *
     * Checks if the card array contains all ranks between min-rank
     * and min-rank + 4 of the given suit
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
