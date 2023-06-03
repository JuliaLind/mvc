<?php

namespace App\ProjectGrid;

use App\ProjectCard\Card;

/**
 * Class representing a grid for cards
 */
class GridCols
{
    /**
     * @param array<array<Card>> $rows
     * @return array<array<Card>>
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
