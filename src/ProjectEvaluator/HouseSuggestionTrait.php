<?php

namespace App\ProjectEvaluator;

use App\ProjectGrid\Grid;
use App\ProjectRules\CountBySuitTrait;

/**
 * Trait for generating a suggestion on best slot to place the dealt card.
 * Also calculates and returns statistics on the best possible rule that can be achieved with/without
 * the dealt card for all the 10 hands, from kmom10/Project
 */
trait HouseSuggestionTrait
{
    use EmptyCellTrait;

    /**
     * Returns the best row to place the card,
     * prioritizes same suit
     * @param array<array<string>> $rows
     */
    abstract private function getRow(string $card, array $rows): int;

    /**
     * Returns the best column in the row to place the card,
     * prioritizes same rank
     * @param array<array<string>> $rows
     * @param array<string> $rowHand
     * @param array<string> $deck
     */
    abstract private function getCol(string $card, array $rowHand, array $rows, array $deck): int;

    /**
     * The main method for generating the statistics of possible rules for all ten hands
     * with and without the dealt card and a suggestion of the best slot to place the dealt card
     * @param array<string> $deck - ranks of the cards from the deck that will be dealt to the player in the remaining game
     * @return array<int>
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function houseSuggestion(Grid $grid, string $card, array $deck): array
    {
        $rows = $grid->getRows();
        $row = 0;
        $col = 0;
        if ($rows === []) {
            return [0, 0];
        }
        if ($deck === []) {
            return $this->oneEmpty($grid);
        }

        $row = $this->getRow($card, $rows);

        $rowHand = [];
        if (array_key_exists($row, $rows)) {
            $rowHand = $rows[$row];
        }

        $col = $this->getCol($card, $rowHand, $rows, $deck);
        return [$row, $col];
    }
}
