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
     * returns the "weight" of the column
     * @param array<array<string>> $cols
     * @param array<string> $deck
     */
    abstract private function getColWeight(int $col, array $cols, string $card, array $deck): float;

    /**
     * Returns the best column in the row to place the card,
     * prioritizes same rank
     * @param array<array<string>> $rows
     * @param array<string> $rowHand
     * @param array<string> $deck
     */
    private function getCol(string $card, array $rowHand, array $rows, array $deck): int
    {
        $cols = $this->getCols($rows);

        $weightCols = [];
        for ($i = 0; $i <= 4; $i++) {
            if (!array_key_exists($i, $rowHand)) {
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
