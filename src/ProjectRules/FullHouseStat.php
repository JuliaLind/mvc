<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class FullHouseStat extends Rule implements RuleStatInterface
{
    protected int $minCountRank = 2;
    protected int $maxCountRank = 3;
    /**
     * @param array<Card> $hand
     * @param array<Card> $deck
     * @param Card $card
     * @return bool true if rule is still possible given passed value
     * otherwise false
     */
    public function check(array $hand, array $deck, Card $card): bool
    {
        /**
         * @var array<Card> $newHand
         */
        $newHand = [...$hand, $card];

        $uniqueCountHand = $this->cardCounter->count($newHand);
        // $rank = $card->getRank();

        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];
        $ranksCount = count($ranksHand);

        if ($ranksCount > 2 || max($ranksHand) > 3) {
            return false;
        }

        $allCards = array_merge($newHand, $deck);
        $uniqueCountAllCards = $this->cardCounter->count($allCards);
        /**
         * @var array<int,int> $uniqeRanksTotal
         */
        $uniqeRanksTotal = $uniqueCountAllCards['ranks'];
        $countRanksTotal = [];
        forEach(array_keys($ranksHand) as $rankInHand) {
            $countRanksTotal[$rankInHand] = $uniqeRanksTotal[$rankInHand];
        }
        if (max($uniqeRanksTotal) >= 3 && min($uniqeRanksTotal) >= 2) {
            return true;
        }
        return false;
    }
}
