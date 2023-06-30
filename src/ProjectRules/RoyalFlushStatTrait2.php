<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait RoyalFlushStatTrait2
{
    /**
     * @param array<string> $cards
     * @return array<string,array<int,int>>
     */
    abstract private function groupBySuit($cards): array;
    /**
     * @param array<int> $ranks
     */
    abstract private function checkForRanks($ranks, int $minRank): bool;

    /**
     * @param array<string> $deck
     */
    public function check3(array $deck): bool
    {
        /**
         * @var array<string,array<int>> $cardsBySuit
         */
        $cardsBySuit = $this->groupBySuit($deck);
        foreach($cardsBySuit as $ranks) {
            if ($this->checkForRanks($ranks, 10)) {
                return true;
            }
        }
        return false;
    }
}