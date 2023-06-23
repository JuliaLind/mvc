<?php

namespace App\ProjectRules;

use App\ProjectCard\Deck;
use App\ProjectGrid\EmptyCellFinder;
use App\ProjectGrid\EmptyCellFinder2;
use App\ProjectGrid\ColumnGetter;

trait TwoPairsTrait
{
    /**
     * @var array<array<string,string|RuleStatInterface|int>>
     */
    private array $rules;
    private EmptyCellFinder $finder;
    private ColumnGetter $colGetter;

    /**
     * @param array<string> $deck
     */
    public function checkInDeck(array $deck, int $rank): bool
    {
        $uniqueCountDeck = $this->cardCounter->count($deck);
        /**
         * @var array<int,int> $ranksDeck
         */
        $ranksDeck = $uniqueCountDeck['ranks'];
        if (!array_key_exists($rank, $ranksDeck)) {
            return false;
        }
        foreach($ranksDeck as $rank2 => $count) {
            if ($rank2 != $rank && $count >= 2) {
                return true;
            }
        }
        return false;
    }
}
