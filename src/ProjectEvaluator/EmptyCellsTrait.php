<?php

namespace App\ProjectEvaluator;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Extracts and returns empty cells from a hand
 * (either all empty cells or the first one), from kmom10/Project
 */
trait EmptyCellsTrait
{
    /**
     * Used in:
     * SlotTrait,
     * EmptyCellTrait
     *
     * Returns an array with coordinates [row,col]
     * for all empty slots in a hand
     * @param array<string> $hand
     * @return array<array<int,int>>
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
    */
    private function singleHand(array $hand, int $index, bool $one = false): array
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
}
