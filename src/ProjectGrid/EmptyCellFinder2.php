<?php

namespace App\ProjectGrid;

class EmptyCellFinder2
{
    /**
     * @var array<int> $slot
     */
    private array $slot = [];

    /**
     * @var array<array<int,string>> $rows
     */
    private array $rows = [];


    private function setSlot(int $row, int $col): void
    {
        $rows = $this->rows;
        if (!array_key_exists($row, $rows) || !array_key_exists($col, $rows[$row])) {
            $this->slot = [$row, $col];
        }
    }
    /**
     * @param array<array<int,string>> $rows
     * @param array<array<int,string>> $cols
     * @return array<int>
     */
    public function oneCell($rows, $cols): array
    {
        $this->rows = $rows;

        for ($row = 0; $row <= 4; $row++) {
            for ($col = 0; $col <= 4; $col++) {
                if (!array_key_exists($row, $rows) && !array_key_exists($col, $cols)) {
                    return [$row, $col];
                }
                $this->setSlot($row, $col);
                // if (!array_key_exists($row, $rows) || !array_key_exists($col, $rows[$row])) {
                //     $slot = [$row, $col];
                // }
            }
        }
        return $this->slot;
    }
}
