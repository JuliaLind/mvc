<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for checking if an array of cards contains
 * a straight flush starting with given min rank
 * and suit. Initially intended to be used in both Straight Flush and Royal flush and therefore
 * quite general. In practice only used for Royal Flush because
 * ended up using a different method for Straight Flush.
 * From kmom10/Project
 */
trait RoyalFlushTrait3
{
    use SearchSpecificCardTrait;

    private int $maxRank;
    private int $minRank;
    private string $suit;

    /**
     * Used in the following traits:
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
