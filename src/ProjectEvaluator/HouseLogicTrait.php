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
trait HouseLogicTrait
{
    /**
     * Returns additiona weight to column if a rule can be scored with the dealt card
     * @param array<string> $hand
     * @param array<string> $deck
     */
    private function addWeight(array $hand, array $deck, string $card): int
    {
        $rules = [
            new SameOfAKind(4),
            new FullHouse(),
            new SameOfAKind(3),
            new TwoPairs(),
            new SameOfAKind(2)
        ];
        $weight = 0;
        foreach($rules as $rule) {
            if ($rule->possibleWithCard($hand, $deck, $card)) {
                $weight += ($rule->getPoints() + $rule->getAdditionalValue());
                break;
            }
        };
        return $weight;
    }
}
