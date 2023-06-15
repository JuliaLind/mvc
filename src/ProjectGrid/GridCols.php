<?php

namespace App\ProjectGrid;

/**
 * Class representing a grid for cards
 */
class GridCols
{
    /**
     * @param array<array<string>> $rows
     * @return array<array<string>>
     */
    public function all($rows): array
    {
        $cols = [];
        foreach($rows as $row => $cards) {
            foreach($cards as $col => $card) {
                $cols[$col][$row] = $card;
            }
        }
        return $cols;
    }
}
