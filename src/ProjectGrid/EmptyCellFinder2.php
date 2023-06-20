<?php

namespace App\ProjectGrid;

class EmptyCellFinder2
{
    /**
     * @param array<array<int,string>> $rows
     * @param array<array<int,string>> $cols
     * @return array<int>
     */
    public function oneCell($rows, $cols): array
    {
        $slot = [];
        for ($row = 0; $row <= 4; $row++) {
            for ($col = 0; $col <= 4; $col++) {
                if (!array_key_exists($row, $rows) && !array_key_exists($col, $cols)) {
                    return [$row, $col];
                }
                if (!array_key_exists($row, $rows) || !array_key_exists($col, $rows[$row])) {
                    $slot = [$row, $col];
                }
            }
        }
        return $slot;
    }
}
