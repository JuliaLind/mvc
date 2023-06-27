<?php

namespace App\ProjectRules;

/**
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
trait EvaluatorTrait2
{
    /**
     * @param array<int,array<string,int|string>> $pointsRows
     * @param array<int,array<string,int|string>> $pointsCols
     * @param array<array<string>> $rows
     * @return array<string,array<int,int>|int|string>
     */
    public function slot(array $pointsRows, array $pointsCols, int $bestRow, array $rows, bool $inverted=false): array
    {
        /**
         * @var string $rowRule
         */
        $rowRule = $pointsRows[$bestRow]['rule'];
        $colRule = "";
        $row = [];
        if (array_key_exists($bestRow, $rows)) {
            $row = $rows[$bestRow];
        }
        $emptySlots = $this->finder->single($row, $bestRow);
        $slot = $emptySlots[0];
        $colPoints = -1000;

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
                'slot' => [$slot[1], $slot[0]]
            ];
        }
        return [
            'col-rule' => $colRule,
            'row-rule' => $rowRule,
            'slot' => $slot
        ];
    }
}
