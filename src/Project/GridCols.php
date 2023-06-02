<?php

namespace App\Project;

/**
 * Class representing a grid for cards
 */
class GridCols
{
    /**
     * @var array<array<Card>> $rows
     * [
     * [01, 02, 03, 04, 05],
     * [11, 12, 13, 14, 15],
     * [21, 22, 23, 24, 25],
     * [31, 32, 33, 34, 35],
     * [41, 42, 43, 44, 45],
     * ]
     */
    private array $rows = [];

    /**
     * @param array<array<Card>> $rows
     */
    public function setRows(array $rows): void
    {
        $this->rows = $rows;
    }

    /**
     * @return array<array<Card>>
     */
    public function all(): array
    {
        $rows = $this->rows;
        $cols = [];
        foreach($rows as $row => $cards) {
            foreach($cards as $col => $card) {
                $cols[$col][$row] = $card;
            }
        }
        return $cols;
    }

    /**
     * @return array<int>
     */
    public function emptyCols(int $row): array
    {
        $rows = $this->rows;
        if (!array_key_exists($row, $rows)) {
            return [0, 1, 2, 3, 4];
        }
        $row = $rows[$row];
        $cols = [];
        for ($col = 0; $col < 5; $col++) {
            if (!array_key_exists($col, $row)) {
                array_push($cols, $col);
            }
        }
        return $cols;
    }
}
