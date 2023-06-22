<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

class FullHouseStat extends Rule implements RuleStatInterface
{
    protected int $minCountRank = 2;
    protected int $maxCountRank = 3;

    /**
     * @param array<string> $hand
     * @param array<string> $deck
     * @return bool true if rule is still possible given passed value
     * otherwise false
     */
    public function check(array $hand, array $deck, string $card): bool
    {
        /**
         * @var array<string> $newHand
         */
        $newHand = [...$hand, $card];

        return $this->check2($newHand, $deck);
    }

        /**
     * @param array<string> $hand
     * @param array<string> $deck
     * @return bool true if rule is still possible given passed value
     * otherwise false
     */
    public function check2(array $hand, array $deck): bool
    {
        $uniqueCountHand = $this->cardCounter->count($hand);

        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];
        $ranksCount = count($ranksHand);

        if ($ranksCount > 2 || max($ranksHand) > 3) {
            return false;
        }

        $allCards = array_merge($hand, $deck);
        $uniqueCountAllCards = $this->cardCounter->count($allCards);
        /**
         * @var array<int,int> $uniqeRanksTotal
         */
        $uniqeRanksTotal = $uniqueCountAllCards['ranks'];
        $countRanksTotal = [];
        foreach(array_keys($ranksHand) as $rankInHand) {
            $countRanksTotal[$rankInHand] = $uniqeRanksTotal[$rankInHand];
        }

        return max($countRanksTotal) >= 3 && min($countRanksTotal) >= 2;
    }
}
