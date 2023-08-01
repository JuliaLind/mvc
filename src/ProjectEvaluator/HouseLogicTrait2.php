<?php

namespace App\ProjectEvaluator;

use App\ProjectGrid\Grid;
use App\ProjectRules\SameOfAKind;
use App\ProjectRules\FullHouse;
use App\ProjectRules\TwoPairs;

/**
 * Trait for generating a suggestion on best slot to place the dealt card.
 * Also calculates and returns statistics on the best possible rule that can be achieved with/without
 * the dealt card for all the 10 hands, from kmom10/Project
 */
trait HouseLogicTrait2
{
    /**
     * Returns additiona weight to column if a rule can be scored with the dealt card
     * @param array<string> $hand
     * @param array<string> $deck
     */
    abstract private function addWeight(array $hand, array $deck, string $card): int;

    /**
     * Adjusts down the weight if one of the prioritized rules can be scored
     * without the dealt card and the not as good rule with the dealt card
     */
    private function adjustWeight(float $pointsWithout, float $weightCol): float
    {
        if ($pointsWithout > $weightCol) {
            $weightCol -= $pointsWithout;
        }
        return $weightCol;
    }

    /**
     * returns the "weight" of the column
     * @param array<array<string>> $cols
     * @param array<string> $deck
     */
    private function getColWeight(int $col, array $cols, string $card, array $deck): float
    {
        $hand = [];
        $weightCol = 0.5;

        $prioRules = [
            new SameOfAKind(4),
            new FullHouse(),
            new SameOfAKind(3),
        ];
        $pointsWithout = 0;
        if (array_key_exists($col, $cols)) {
            $hand = $cols[$col];
            $weightCol -= 0.5;
            foreach($prioRules as $rule) {
                if ($rule->possibleWithOutCard($hand, $deck)) {
                    $pointsWithout = $rule->getPoints();
                    break;
                }
            };
        }

        $weightCol += $this->addWeight($hand, $deck, $card);
        return $this->adjustWeight($pointsWithout, $weightCol);
    }
}
