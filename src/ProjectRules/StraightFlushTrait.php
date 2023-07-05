<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait StraightFlushTrait
{
    // use CountBySuitTrait;
    use MinRankLimitsTrait;

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
     * Returns true if rule is possible to
     * score wuthout the dealt card.
     * @param array<string> $hand
     * @param array<string> $deck
     */
    public function possibleWithoutCard(array $hand, array $deck): bool
    {
        /**
         * @var array<string,array<int>> $handBySuit
         */
        $handBySuit = $this->groupBySuit($hand);

        if (count($handBySuit) > 1) {
            return false;
        }
        $ranks = array_values($handBySuit)[0];
        $maxRank = max($ranks);
        $minRank = min($ranks);
        if ($maxRank - $minRank > 4) {
            return false;
        }
        $minRankLimits = $this->minRankLimits($minRank, $maxRank);
        $minMinRank = $minRankLimits['min'];
        $maxMinRank = $minRankLimits['max'];

        /**
         * @var string $suit
         */
        $suit = array_key_first($handBySuit);
        $allCards = array_merge($hand, $deck);
        /**
         * @var array<string,array<int>> $cardsBySuit
         */
        $cardsBySuit = $this->groupBySuit($allCards);
        $allRanks = $cardsBySuit[$suit];

        // return $this->setRankLimits($hand) && $this->checkAllPossible($ranks, min($ranks), max($ranks) - 4);
        return $this->checkAllPossible($allRanks, $minMinRank, $maxMinRank);
    }
}
