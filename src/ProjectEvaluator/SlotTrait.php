<?php

namespace App\ProjectEvaluator;

trait SlotTrait
{
    /**
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     * From EmptyCellsTrait
     *
     * Returns an array with coordinates [row,col]
     * for all empty slots in a hand
     * @param array<string> $hand
     * @return array<array<int,int>>
    */
    abstract private function singleHand(array $hand, int $index, bool $one = false): array;

    /**
     * Used in SuggestionTrait
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     * @param array<int,array<string,float|int|string>> $pointsRows
     * @param array<int,array<string,float|int|string>> $pointsCols
     * @param array<array<string>> $rows
     * @return array<string,array<int,int>|int|string>
     */
    private function bestSlot(array $pointsRows, array $pointsCols, int $bestRow, array $rows, bool $inverted=false): array
    {
        /**
         * @var string $rowRule
         */
        $rowRule = $pointsRows[$bestRow]['rule-with-card'];
        /**
         * @var int $rowPoints
         */
        $rowPoints = $pointsRows[$bestRow]['weight'];
        $colRule = "";
        $row = [];
        if (array_key_exists($bestRow, $rows)) {
            $row = $rows[$bestRow];
        }
        $emptySlots = $this->singleHand($row, $bestRow);
        $slot = $emptySlots[0];
        /**
         * Just a low value to start with, since all the slots are
         * empty they will all have a higher value (adjusted points)
         */
        $colPoints = -200;

        foreach($emptySlots as $emptySlot) {
            $col = $emptySlot[1];
            /**
             * @var int $pointsCol
             */
            $pointsCol = $pointsCols[$col]['weight'];
            if ($pointsCol >= $colPoints) {
                $colPoints = $pointsCol;
                $slot = $emptySlot;
                /**
                 * @var string $colRule
                 */
                $colRule = $pointsCols[$col]['rule-with-card'];
            }
        }
        if ($inverted === true) {
            return [
                'col-rule' => $rowRule,
                'row-rule' => $colRule,
                'slot' => [$slot[1], $slot[0]],
                'tot-weight-slot' => $rowPoints + $colPoints
            ];
        }
        return [
            'col-rule' => $colRule,
            'row-rule' => $rowRule,
            'slot' => $slot,
            'tot-weight-slot' => $rowPoints + $colPoints
        ];
    }
}
