<?php

namespace App\ProjectEvaluator;

use App\ProjectGrid\Grid;
// use App\ProjectRules\RuleInterface;
use App\ProjectRules\SameOfAKind;
use App\ProjectRules\FullHouse;
use App\ProjectRules\Flush;
use App\ProjectRules\TwoPairs;

/**
 * Trait for generating a suggestion on best slot to place the dealt card.
 * Also calculates and returns statistics on the best possible rule that can be achieved with/without
 * the dealt card for all the 10 hands, from kmom10/Project
 */
trait HouseColSuggestionTrait
{
    /**
     * From RowsToColsTrait
     *
     * Returns a two-dimensional array
     * wich correspons to an "inverted version" of the grid,
     * (i.e. an array with vertical hands)
     * @param array<array<string>> $rows
     * @return array<array<string>>
     */
    abstract private function getCols($rows): array;

    /**
     * Returns the best column in the row to place the card,
     * prioritizes same rank
     * @param array<array<string>> $rows
     * @param array<string> $rowHand
     * @param array<string> $deck
     */
    private function getCol(string $card, array $rowHand, array $rows, array $deck): int
    {
        $col = 0;
        $cols = $this->getCols($rows);

        $rules = [
            new SameOfAKind(4),
            new FullHouse(),
            new SameOfAKind(3),
            new TwoPairs(),
            new SameOfAKind(2)
        ];
        $weightCols = [];
        for ($i = 0; $i <= 4; $i++) {
            if (!array_key_exists($i, $rowHand)) {
                $col = $i;
                $hand = [];
                $weightCols[$i] = 0.5;
                if (array_key_exists($i, $cols)) {
                    $hand = $cols[$i];
                    $weightCols[$i] = 0;
                }

                foreach($rules as $rule) {
                    if ($rule->possibleWithCard($hand, $deck, $card)) {
                        $weightCols[$i] = $rule->getPoints() + $rule->getAdditionalValue();
                        break;
                    }
                };
            }
        }
        /**
         * @var int $col
         */
        $col = array_search(max($weightCols), $weightCols);
        return $col;
    }
}
