<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait RoyalFlushTrait2
{
    /**
     * From GroupBySuitTrait
     *
     * Returns an associative array with keys
     * correspoding to suits present in the cards
     * array and values - arrays containing the ranks
     * of each suit present in the card-array
     * @param array<string> $cards
     * @return array<string,array<int,int>>
     */
    abstract private function groupBySuit($cards): array;

    /**
     * From StraightTrait2
     *
     * Returns true if a straight where the 'minRank' is the
     * lowest rank is possible in the given ranks,
     * otherwise returns false
     * @param array<int> $ranks
     */
    abstract private function checkForRanks(array $ranks, int $minRank): bool;

    /**
     * Returns true if is is possible to score a RoyalFlush
     * with only the cards that will be dealt to the player from the deck
     * @param array<string> $deck
     */
    public function possibleDeckOnly(array $deck): bool
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
