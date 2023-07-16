<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for checking if a Straight Flush rule can
 * be scored in an emtpy hand without the dealt card.
 * From kmom10/Project
 */
trait StraightFlushTrait3
{
    /**
     * From StraightTrait3.
     *
     * Given an array of ranks and the lowest min-rank
     * and the highest min rank that a straight
     * can have, determins if it is possible to
     * achieve a straight
     * @param array<int> $ranks
     */
    abstract private function checkAllPossible($ranks, int $minMinRank, int $maxMinRank): bool;

    /**
     * From GroupBySuitTrait
     * Returns an associative array with keys
     * correspoding to suits present in the cards
     * array and values - arrays containing the ranks
     * of each suit present in the card-array
     * @param array<string> $cards
     * @return array<string,array<int,int>>
     */
    abstract private function groupBySuit($cards): array;


    /**
     * Used when hand is empty. Returns true if the
     * rule is possible to score with the cards that
     * will be dealt from deck
     * @param array<string> $deck - cards that will be dealt to the user in the remaining game
     */
    public function possibleDeckOnly(array $deck): bool
    {
        /**
         * @var array<string,array<int>> $cardsBySuit
         */
        $cardsBySuit = $this->groupBySuit($deck);

        foreach($cardsBySuit as $ranks) {
            /**
             * @var array<int> $ranks
             */
            if (count($ranks) >= 5) {
                if ($this->checkAllPossible($ranks, min($ranks), max($ranks) - 4) === true) {
                    return true;
                }
            }
        }
        return false;
    }
}
