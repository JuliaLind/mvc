<?php

namespace App\ProjectEvaluator;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;

/**
 * Fins and returns the first empty cell in a grid
 */
trait EmptyCellTrait
{
    use EmptyCellsTrait;

    /**
     * Used in SuggestionTrait
     *
     * Returns  an array with coordinates [row,col]
     * for the first available empty slot
     * @return array<int>
     */
    private function oneEmpty(Grid $grid): array
    {
        if ($grid->getCardCount() === 25) {
            throw new NoEmptySlotsException();
        }
        $hands = $grid->getRows();
        $slot = [];
        for ($row = 0; $row < 5; $row++) {
            if (array_key_exists($row, $hands) && count($hands[$row]) < 5) {
                $slot = $this->singleHand($hands[$row], $row, true)[0];
                break;
            } elseif (!array_key_exists($row, $hands)) {
                $slot = [$row, 0];
                break;
            }
        }
        return $slot;
    }
}
