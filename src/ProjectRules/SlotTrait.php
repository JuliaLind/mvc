<?php

namespace App\ProjectRules;

trait SlotTrait
{
    use EmptyCellTrait;

    /**
     * Used in SuggestionTrait
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     * @param array<int,array<string,int|string>> $pointsRows
     * @param array<int,array<string,int|string>> $pointsCols
     * @param array<array<string>> $rows
     * @return array<string,array<int,int>|int|string>
     */
    private function bestSlot(array $pointsRows, array $pointsCols, int $bestRow, array $rows, bool $inverted=false): array
    {
        /**
         * @var string $rowRule
         */
        $rowRule = $pointsRows[$bestRow]['rule'];
        /**
         * @var int $rowPoints
         */
        $rowPoints = $pointsRows[$bestRow]['points'];
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
            $pointsCol = $pointsCols[$col]['points'];
            if ($pointsCol >= $colPoints) {
                $colPoints = $pointsCol;
                $slot = $emptySlot;
                /**
                 * @var string $colRule
                 */
                $colRule = $pointsCols[$col]['rule'];
            }
        }
        if ($inverted === true) {
            return [
                'col-rule' => $rowRule,
                'row-rule' => $colRule,
                'slot' => [$slot[1], $slot[0]],
                'tot-weight-points-slot' => $rowPoints + $colPoints
            ];
        }
        return [
            'col-rule' => $colRule,
            'row-rule' => $rowRule,
            'slot' => $slot,
            'tot-weight-points-slot' => $rowPoints + $colPoints
        ];
    }
}
