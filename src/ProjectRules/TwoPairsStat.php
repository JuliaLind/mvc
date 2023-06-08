<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

class TwoPairsStat extends RuleStat implements RuleStatInterface
{
    protected int $minCountRank = 2;

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

        $uniqueCountHand = $this->cardCounter->count($hand);
        $rank = $card->getRank();

        /**
         * @var array<int,int> $ranksHand
         */
        $ranksHand = $uniqueCountHand['ranks'];

        $allCards = array_merge($newHand, $deck);
        $searcher = $this->searcher;
        return array_key_exists($rank, $ranksHand) && count($hand) > count($ranksHand) && $searcher->checkRankQuant($allCards, $rank, $this->minCountRank);
    }
}
