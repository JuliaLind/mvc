<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait StraightFlushTrait
{
    /**
     * From SameSuitTrait.
     * Sets suit attribute to the suit of the
     * first card in the hand and
     * returns true if all cards in the hand are
     * of the same suit
     * @param array<string> $hand
     */
    abstract private function setSuit(array $hand): bool;

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
     * From RankLimitsTrait.
     * Sets the minRank and maxRank attributes to the
     * min rank in the hand and max rank in the hand.
     * Returns true if the difference between max rank
     * and min rank is no bigger than 4
     * @param array<string> $hand
     */
    abstract private function setRankLimits(array $hand): bool;

    /**
     * Returns true if rule is possible to
     * score wuthout the dealt card.
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function possibleWithoutCard(array $hand, array $deck): bool
    {
        if (!$this->setSuit($hand)) {
            return false;
        }
        $allCards = array_merge($hand, $deck);
        /**
         * @var array<string,array<int>> $cardsBySuit
         */
        $cardsBySuit = $this->groupBySuit($allCards);
        $ranks = $cardsBySuit[$this->suit];

        return $this->setRankLimits($hand) && $this->checkAllPossible($ranks, min($ranks), max($ranks) - 4);
    }


    /**
     * Used when hand is empty. Returns true if the
     * rule is possible to score with the cards that
     * will be dealt from deck
     * @param array<string> $deck
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
