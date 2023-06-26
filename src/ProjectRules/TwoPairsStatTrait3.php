<?php

namespace App\ProjectRules;

use App\ProjectCard\Deck;
use App\ProjectGrid\EmptyCellFinder;
use App\ProjectGrid\EmptyCellFinder2;
use App\ProjectGrid\ColumnGetter;

trait TwoPairsStatTrait3
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
    private function subCheck4($hand, $ranksHand, $ranksDeck): bool
    {
        return (max($ranksHand) === 2 && min($ranksHand) === 2) || (count($hand) <= 3 && max($ranksDeck) >= 2);
    }

    /**
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck5(array $ranksHand, array $ranksDeck): bool
    {
        foreach(array_keys($ranksHand) as $rank) {
            if (array_key_exists($rank, $ranksDeck)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param array<int,int> $ranksHand
     * @param array<int,int> $ranksDeck
     */
    private function subCheck6(array $ranksHand, array $ranksDeck): bool
    {
        $pairs = 0;
        foreach(array_keys($ranksHand) as $rank) {
            if (array_key_exists($rank, $ranksDeck)) {
                $pairs += 1;
            }
            if ($pairs === 2) {
                return true;
            }
        }
        return false;
    }
}
