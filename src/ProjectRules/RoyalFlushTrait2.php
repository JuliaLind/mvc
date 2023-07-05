<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait RoyalFlushTrait2
{
    use GroupBySuitTrait;
    use StraightTrait2;

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
