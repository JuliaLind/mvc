<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;

/**
 * Extracts empty cells from grid
 */
trait EmptyCellTrait
{
    /**
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     * Used in SlotTrait
     *
     * Returns an array with coordinates [row,col]
     * for all empty slots in a hand
     * @param array<string> $hand
     * @return array<array<int,int>>
    */
    private function single(array $hand, int $index, bool $one = false): array
    {
        $empty = [];
        for ($col = 0; $col < 5; $col++) {
            if (!array_key_exists($col, $hand)) {
                array_push($empty, [$index, $col]);
                if ($one === true) {
                    break;
                }
            }
        }
        return $empty;
    }

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
                $slot = $this->single($hands[$row], $row, true)[0];
                break;
            } elseif (!array_key_exists($row, $hands)) {
                $slot = [$row, 0];
                break;
            }
        }
        return $slot;
    }
}
