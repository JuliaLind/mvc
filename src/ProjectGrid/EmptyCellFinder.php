<?php

namespace App\ProjectGrid;

class EmptyCellFinder
{
    // /**
    //  * @param array<string> $row
    //  * @return array<array<int,int>>
    //  */
    // public function single(array $row, int $rowNr, bool $notEmpty): array
    // {
    //     $empty = [];
    //     for ($col = 0; $col < 5; $col++) {
    //         if ($notEmpty === false || !array_key_exists($col, $row)) {
    //             array_push($empty, [$rowNr, $col]);
    //         }
    //     }
    //     return $empty;
    // }

    /**
     * @param array<string> $row
     * @return array<array<int,int>>
     */
    public function single(array $row, int $rowNr): array
    {
        $empty = [];
        for ($col = 0; $col < 5; $col++) {
            if (!array_key_exists($col, $row)) {
                array_push($empty, [$rowNr, $col]);
            }
        }
        return $empty;
    }

    // /**
    //  * @param array<array<string>> $rows
    //  * @return array<array<int,int>> [row][col]
    //  */
    // public function all($rows): array
    // {
    //     $empty = [];
    //     for ($row = 0; $row < 5; $row++) {
    //         $singleRow = [];
    //         $bool = array_key_exists($row, $rows);
    //         if ($bool === true) {
    //             $singleRow = $rows[$row];
    //         }

    //         $cells = $this->single($singleRow, $row, $bool);
    //         $empty = array_merge($empty, $cells);
    //     }
    //     return $empty;
    // }

    /**
     * @param array<array<string>> $rows
     * @return array<array<int,int>> [row][col]
     */
    public function all($rows): array
    {
        $empty = [];
        for ($rowNr = 0; $rowNr < 5; $rowNr++) {
            $row = [];
            $bool = array_key_exists($rowNr, $rows);
            if ($bool === true) {
                $row = $rows[$rowNr];
            }

            $cells = $this->single($row, $rowNr);
            $empty = array_merge($empty, $cells);
        }
        return $empty;
    }
}
