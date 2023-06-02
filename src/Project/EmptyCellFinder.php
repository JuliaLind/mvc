<?php

namespace App\Project;

class EmptyCellFinder
{
    /**
     * @param array<Card> $row
     * @return array<array<int,int>>
     */
    public function single(array $row, int $rowNr, bool $notEmpty): array
    {
        $empty = [];
        for ($col = 0; $col < 5; $col++) {
            if ($notEmpty == false || !array_key_exists($col, $row)) {
                // array_push($empty, [
                //     'row' => $rowNr,
                //     'col' => $col
                // ]);
                array_push($empty, [$rowNr, $col]);
            }
        }
        return $empty;
    }

    /**
     * @param array<array<Card>> $rows
     * @return array<array<int,int>> [row][col]
     */
    public function all($rows): array
    {
        $empty = [];
        for ($row = 0; $row < 5; $row++) {
            $singleRow = [];
            $bool = array_key_exists($row, $rows);
            if ($bool == true) {
                $singleRow = $rows[$row];
            }

            $cells = $this->single($singleRow, $row, $bool);
            $empty = array_merge($empty, $cells);
        }
        return $empty;
    }
}
