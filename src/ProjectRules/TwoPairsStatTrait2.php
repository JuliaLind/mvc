<?php

namespace App\ProjectRules;

use App\ProjectCard\Deck;
use App\ProjectGrid\EmptyCellFinder;
use App\ProjectGrid\EmptyCellFinder2;
use App\ProjectGrid\ColumnGetter;

trait TwoPairsStatTrait2
{
    /**
     * @var array<array<string,string|RuleStatInterface|int>>
     */
    private array $rules;
    private EmptyCellFinder $finder;
    private ColumnGetter $colGetter;


    /**
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck(array $hand, int $rank, array $ranksHand, array $ranksDeck): bool
    {
        if (count($hand) < 4) {
            return array_key_exists($rank, $ranksHand) || array_key_exists($rank, $ranksDeck);
        }
        return array_key_exists($rank, $ranksHand);
    }

    /**
     * @param array<string> $hand
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck2(array $hand, int $rank, array $ranksHand, array $ranksDeck): bool
    {
        if (count($hand) === 1) {
            /**
             * @var int $maxRankDeck
             */
            $maxRankDeck = max($ranksDeck);
            if ((array_key_exists($rank, $ranksHand) && $maxRankDeck >= 2) || (array_key_exists($rank, $ranksDeck) && array_key_exists(array_keys($ranksHand)[0], $ranksDeck))) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck3(int $rank, array $ranksHand, array $ranksDeck): bool
    {
        if (array_key_exists($rank, $ranksHand)) {
            foreach($ranksHand as $rank2) {
                if (array_key_exists($rank2, $ranksDeck)) {
                    return true;
                }
            }
        }
        return false;
    }
}
