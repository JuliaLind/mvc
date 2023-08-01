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

        $rules = [
            new SameOfAKind(4),
            new FullHouse(),
            new SameOfAKind(3),
            new TwoPairs(),
            new SameOfAKind(2)
        ];
        $pointsWithout = 0;
        if (array_key_exists($col, $cols)) {
            $hand = $cols[$col];
            $weightCol -= 0.5;
            foreach($rules as $rule) {
                if ($rule->possibleWithOutCard($hand, $deck)) {
                    $pointsWithout = $rule->getPoints();
                    break;
                }
            };
        }
        foreach($rules as $rule) {
            if ($rule->possibleWithCard($hand, $deck, $card)) {
                $weightCol += ($rule->getPoints() + $rule->getAdditionalValue());
                break;
            }
        };

        return $this->adjustWeight($pointsWithout, $weightCol);
    }

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

        $weightCols = [];
        for ($i = 0; $i <= 4; $i++) {
            if (!array_key_exists($i, $rowHand)) {
                // $col = $i;
                // $hand = [];
                // $weightCol = 0.5;

                // $rules = [
                //     new SameOfAKind(4),
                //     new FullHouse(),
                //     new SameOfAKind(3),
                //     new TwoPairs(),
                //     new SameOfAKind(2)
                // ];
                // $pointsWithout = 0;
                // if (array_key_exists($i, $cols)) {
                //     $hand = $cols[$i];
                //     $weightCol -= 0.5;
                //     foreach($rules as $rule) {
                //         if ($rule->possibleWithOutCard($hand, $deck)) {
                //             $pointsWithout = $rule->getPoints();
                //             break;
                //         }
                //     };
                // }
                // foreach($rules as $rule) {
                //     if ($rule->possibleWithCard($hand, $deck, $card)) {
                //         $weightCol += ($rule->getPoints() + $rule->getAdditionalValue());
                //         break;
                //     }
                // };

                $weightCols[$i] = $this->getColWeight($i, $cols, $card, $deck);
            }
        }
        /**
         * @var int $col
         */
        $col = array_search(max($weightCols), $weightCols);
        return $col;
    }
}
