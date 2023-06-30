<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait StraightFlushStatTrait
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
     * @param array<string> $cards
     */
    private function checkForCards($cards, int $minRank, string $suit): bool
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
