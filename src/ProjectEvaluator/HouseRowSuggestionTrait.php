<?php

namespace App\ProjectEvaluator;

use App\ProjectGrid\Grid;

use App\ProjectRules\RuleInterface;

use App\ProjectRules\CountBySuitTrait;

/**
 * Trait for generating a suggestion on best slot to place the dealt card.
 * Also calculates and returns statistics on the best possible rule that can be achieved with/without
 * the dealt card for all the 10 hands, from kmom10/Project
 */
trait HouseRowSuggestionTrait
{
    use CountBySuitTrait;
    /**
     * Returns the best row to place the card,
     * prioritizes same suit
     * @param array<array<string>> $rows
     */
    private function getRow(string $card, array $rows): int
    {
        $row = 0;
        for ($i = 0; $i <= 4; $i++) {
            if (!array_key_exists($i, $rows)) {
                $row = $i;
                break;
            }
            $hand = $rows[$i];
            if (count($hand) < 5) {
                $row = $i;
                $suits = $this->countBySuit([...$hand, $card]);
                if (count($suits) === 1) {
                    break;
                }
            }
        }
        return $row;
    }
}
