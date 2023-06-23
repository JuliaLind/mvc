<?php

namespace App\ProjectRules;

use App\ProjectCard\Deck;
use App\ProjectGrid\EmptyCellFinder;
use App\ProjectGrid\EmptyCellFinder2;
use App\ProjectGrid\ColumnGetter;

trait TwoPairsTrait2
{
    /**
     * @var array<array<string,string|RuleStatInterface|int>>
     */
    private array $rules;
    private EmptyCellFinder $finder;
    private ColumnGetter $colGetter;

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

        /**
         * @var array<string> $allCards
         */
        $allCards = array_merge($hand, $deck);

        foreach(array_keys($ranksHand) as $rank) {
            $this->rank = $rank;
            if (count($hand) > count($ranksHand) && $this->searcher->checkRankQuant($allCards, $rank, $this->minCountRank)) {
                return true;
            }
        }
        return false;
    }
}
